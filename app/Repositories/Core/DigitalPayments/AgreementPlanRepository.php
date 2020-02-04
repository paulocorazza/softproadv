<?php
namespace App\Repositories\Core\DigitalPayments;

use App\Models\Company;
use App\Repositories\Contracts\AgreementRepositoryInterface;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class AgreementPlanRepository implements AgreementRepositoryInterface
{
    private $agreement;

    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    public function setAgreement(AgreementRepositoryInterface $agreement)
    {
        $this->agreement = $agreement;
    }

    public function create($id)
    {
        return $this->agreement->create($id);
    }

    public function executeAgreement($token, $company)
    {
       return $this->agreement->executeAgreement($token, $company);
    }

    public function detailAgreement($id)
    {
        return $this->agreement->detailAgreement($id);
    }

    public function updateCompany(Company $company, $id)
    {
       return $this->agreement->updateCompany($company, $id);
    }
}
