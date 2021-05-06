<?php


namespace Factorenergia\Api\Application\Request\Question;


class GetQuestionsRequest
{
    private string $tagged;
    private int $todate;
    private int $fromdate;

    public function __construct(string $tagged, int $todate, int $fromdate )
    {
        $this->tagged = $tagged;
        $this->todate = $todate;
        $this->fromdate = $fromdate;
    }

    public function tagged(): string
    {
        return $this->tagged;
    }

    public function fromdate(): string
    {
        return $this->fromdate;
    }

    public function todate(): string
    {
        return $this->todate;
    }

}