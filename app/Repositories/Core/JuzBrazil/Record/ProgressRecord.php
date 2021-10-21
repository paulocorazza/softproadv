<?php

namespace App\Repositories\Core\JuzBrazil\Record;

class ProgressRecord
{
    use ToArrayTrait;

    public function __construct(private string $process_id,
                                private string $publication,
                                private string $date,
                                private string $data_hash,
                                private string $type,
                                private string $description,
                                private bool $concluded,
                                private string $category)
    {

    }

    /**
     * @return string
     */
    public function getProcessId(): string
    {
        return $this->process_id;
    }

    /**
     * @return string
     */
    public function getPublication(): string
    {
        return $this->publication;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getDataHash(): string
    {
        return $this->data_hash;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function isConcluded(): bool
    {
        return $this->concluded;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }


}
