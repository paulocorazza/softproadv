<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Helpers\Helper;
use App\Models\Process;
use App\Models\ProcessUsers;
use App\Repositories\Contracts\ProcessRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentProcessRepository extends BaseEloquentRepository
    implements ProcessRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */
    private function getPercentProgress($model)
    {
        $countEvents = $model->events->count();
        $countEventsFinish = $model->events()->finish()->count();

        $countProgresses = $model->progresses->count();
        $countProgressesConcluded = $model->progresses()->concluded()->count();

        $totalProgressesEvents = $countProgresses + $countEvents;

        if ($totalProgressesEvents == 0) {
            return 0;
        }

        return Helper::roundTo(($countProgressesConcluded + $countEventsFinish) / $totalProgressesEvents * 100);
    }


    private function saveProgresses(array $data, $process)
    {
        if (isset($data['progresses'])) {

            foreach ($data['progresses'] as $progress) {
                $id = ($progress['id'] > 0) ? $progress['id'] : 0;

                $progress['date'] = Carbon::createFromFormat('d/m/Y', $progress['date'])->format('Y-m-d');

                if (isset($progress['date_term'])) {
                    $progress['date_term'] = Carbon::createFromFormat('d/m/Y', $progress['date_term'])->format('Y-m-d');
                }

                $progress['concluded'] = (isset($progress['concluded'])) ? true : false;
                $progress['published_at'] = now();
                $process->progresses()->updateOrCreate(['id' => $id], $progress);
            }
        }

        return true;
    }

    private function saveAudiences(array $data, $process)
    {
        if (isset($data['audiences'])) {
            foreach ($data['audiences'] as $audience) {
                $id = ($audience['id'] > 0) ? $audience['id'] : 0;

                $audience['user_id'] = Auth::user()->id;
                $audience['color'] = '#000000';
                $audience['schedule'] = true;
                $audience['audience'] = true;
                $audience['start'] = Carbon::createFromFormat('d/m/Y H:i:s', $audience['start'])->format('Y-m-d H:i:s');
                $audience['end'] = Carbon::createFromFormat('d/m/Y H:i:s', $audience['end'])->format('Y-m-d H:i:s');


                $event = $process->events()->updateOrCreate(['id' => $id], $audience);

                $event->users()->sync($audience['users']);
            }
        }

        return true;
    }


    private function saveUsers(array $data, $process)
    {
        if (isset($data['users'])) {
            $this->linkedUserProcess($data['users'], $process);
        }

        return true;
    }


    private function saveFiles(array $data, $process)
    {
        $files = $data['files'];

        if ($files) {
            $filesUploaded = [];

            foreach ($files as $file) {
                if (isset($file['img']) && !empty($file['description'])) {

                    $ext = $file['img']->getClientOriginalExtension();

                    $path = $file['img']->store("files/process/{$process->id}");

                    $filesUploaded['description'] = $file['description'];
                    $filesUploaded['ext'] = $ext;
                    $filesUploaded['file'] = isset(session('company')['uuid']) ? session('company')['uuid'] . '/' . $path : $path;

                    $insert = $process->files()->create($filesUploaded);

                    if (!$insert) {
                        throw new \Exception('Falha ao inserir o arquivo');
                    }
                }
            }
        }

        return true;
    }

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return Process::class;
    }


    public function dataTables($column, $view, $request = null )
    {
        $model = $this->model
            ->query()
            ->with([
                'person',
                'users',
            ]);


        $model->where(function ($query) use ($request) {
            if (!empty($request->get('status'))) {
              $query->where('status', $request->get('status'));
            }

            if (!empty($request->get('users'))) {
                $users = $request->get('users');

                $query->whereHas('users', function ($query) use ($users) {
                    $query->whereIn('users.id', $users);
                });
            }

             if ($request->get('monitoring') === 'true') {
                $query->where('monitoring', true);
            }
        });


        return Datatables()
            ->eloquent($model)
            ->addColumn('listAdv', ' ')
            ->editColumn('listAdv', function ($model) {
                $users = $model->users;
                return view('tenants.processes.partials.listAdv', compact('users'));
            })
            ->addColumn('progress', ' ')
            ->editColumn('progress', function ($model) {
                $percent = $this->getPercentProgress($model);
                return view('tenants.processes.partials.progress', compact('percent'));
            })
            ->addColumn($column, $view)
            ->make(true);
    }


    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $process = parent::create($data);
            $users = $this->saveUsers($data, $process);
            $progresses = $this->saveProgresses($data, $process);
            $files = $this->saveFiles($data, $process);
            $audiences = $this->saveAudiences($data, $process);

            if (!$process || !$progresses || !$files || !$users || !$audiences) {
                DB::rollBack();

                return [
                    'status' => false,
                    'message' => 'Não foi possível salvar o registro'
                ];
            }

            DB::commit();

            return ['status' => true];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => 'Não foi possível salvar o registro.' . $e->getMessage()
            ];
        }
    }


    public function update($id, array $data)
    {
        if (!$process = parent::find($id)) {
            return [
                'status' => false,
                'message' => 'Registro não encontrado!'
            ];
        }


        DB::beginTransaction();

        try {
            $state = $this->saveStage($process, $data);

            $process->update($data);

            $users = $this->saveUsers($data, $process);
            $progresses = $this->saveProgresses($data, $process);
            $audiences = $this->saveAudiences($data, $process);
            $files = $this->saveFiles($data, $process);


            if (!$process || !$progresses || !$files || !$users || !$state || !$audiences) {

                DB::rollBack();

                return [
                    'status' => false,
                    'message' => 'Não foi possível atualizar o registro'
                ];
            }


            DB::commit();

            return ['status' => true];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => 'Não foi possível atualizar o registro.' . $e->getMessage()
            ];
        }
    }

    public function updateContract($id, array $data)
    {
        if (!$process = parent::find($id)) {
            return [
                'status' => false,
                'message' => 'Registro não encontrado!'
            ];
        }
        $update = $process->update($data);

        if (!$update) {
            return [
                'status' => false,
                'message' => 'Não foi possível atualizar o registro.' . $e->getMessage()
            ];

        }

        return [
            'status' => true,
            'process' => $process
        ];
    }

    private function saveStage(Process $process, array $data)
    {
        if ($this->isUpdateStage($process, $data)) {
            $process->stages()->attach([
                $process->stage_id => ['user_id' => Auth::user()->id]
            ]);
        }

        return true;
    }

    /**
     * @param Process $process
     * @param $data
     * @return bool
     */
    private function isUpdateStage(Process $process, $data): bool
    {
        return isset($process->stage_id) && !$process->stages()->find($process->stage_id) && ($process->stage_id != $data['stage_id'] || $data['status'] == 'Concluído');
    }

    public function replaceTags(Process $process): string
    {
        $contract = $process->contract;
        $contract = $this->getReplacePerson($process, $contract);
        $contract = $this->getReplaceCounterPart($process, $contract);
        $contract = $this->getReplaceProcess($process, $contract);
        $contract = $this->getUsers($process, $contract);
        return $this->getUsersOab($process, $contract);
    }

    /**
     * @param Process $process
     * @param mixed $contract
     * @return array|mixed|string|string[]
     */
    private function getUsers(Process $process, mixed $contract): mixed
    {
        $users = array_map(function ($item) {
            return $item['name'];
        }, $process->users->toArray());

        return str_replace('{Advogados}', implode(', ', $users), $contract);
    }

    private function getUsersOab(Process $process, mixed $contract): mixed
    {
        $users = array_map(function ($item) {
            return $item['name'] . ' OAB: ' . $item['oab'];
        }, $process->users->toArray());

        return str_replace('{Advogados/OAB}', implode(', ', $users), $contract);
    }

    /**
     * @param Process $process
     * @param mixed $contract
     * @return array|string|string[]
     */
    private function getReplacePerson(Process $process, mixed $contract): string|array
    {
        $contract = str_replace('{Nome do Cliente}', $process->person->name, $contract);
        $contract = str_replace('{CPF do Cliente}', $process->person->cpf, $contract);
        $contract = str_replace('{CNPJ do Cliente}', $process->person->cnpj, $contract);
        $contract = str_replace('{RG do Cliente}', $process->person->rg, $contract);

        $address = $process->person->addresses()->with('city', 'state', 'country')->first();

        if ($address) {
            $contract = str_replace('{Endereço do Cliente}', $address->street, $contract);
            $contract = str_replace('{Número do Cliente}', $address->number, $contract);
            $contract = str_replace('{Bairro do Cliente}', $address->district, $contract);
            $contract = str_replace('{Complemento do Cliente}', $address->complement, $contract);
            $contract = str_replace('{Cidade do Cliente}', $address->city->title, $contract);
            $contract = str_replace('{UF do Cliente}', $address->state->letter, $contract);
            $contract = str_replace('{País do Cliente}', $address->country->name, $contract);
        }
        return $contract;
    }

    /**
     * @param Process $process
     * @param mixed $contract
     * @return array|string|string[]
     */
    private function getReplaceProcess(Process $process, mixed $contract): string|array
    {
        $contract = str_replace('{Fórum}', (isset($process->forum)) ? $process->forum->name : '{Fórum}' , $contract);
        $contract = str_replace('{Vara}', (isset($process->stick)) ? $process->stick->name : '{Vara}', $contract);
        $contract = str_replace('{Comarca}', (isset($process->district)) ? $process->district->name : '{Comarca}', $contract);

        $contract = str_replace('{Número do Processo}', $process->number_process, $contract);
        $contract = str_replace('{Número do Protocolo}', $process->protocol, $contract);
        $contract = str_replace('{Número da Pasta}', $process->folder, $contract);
        $contract = str_replace('{Data do Requerimento}', $process->date_request, $contract);
        $contract = str_replace('{Expectativa / Valor da causa}', $process->expectancy, $contract);
        $contract = str_replace('{Valor dos honorários}', $process->price, $contract);
        return str_replace('{Honorários %}', $process->percent_fees, $contract);
    }

    /**
     * @param Process $process
     * @param array|string $contract
     * @return array|string|string[]
     */
    private function getReplaceCounterPart(Process $process, array|string $contract): string|array
    {
        return str_replace('{Nome da Parte Contrária}', $process->counterPart->name, $contract);
    }

    /**
     * @param $users
     * @param $process
     */
    private function linkedUserProcess($users, $process): void
    {
        foreach ($users as $user) {
            ProcessUsers::updateOrCreate(['user_id' => $user, 'process_id' => $process->id],
                ['user_id' => $user, 'process_id' => $process->id]
            );
        }
    }
}
