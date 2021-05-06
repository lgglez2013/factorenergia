<?php


namespace Factorenergia\Api\Application\Query\Question;


use Factorenergia\Api\Application\Request\Question\GetQuestionsRequest;
use Factorenergia\Api\Application\Response\Question\QuestionCollectionResponse;
use Factorenergia\Api\Domain\Model\Question\QuestionRepository;

class GetQuestionsHandler
{
    private QuestionRepository $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function __invoke(GetQuestionsRequest $getQuestionsRequest): QuestionCollectionResponse
    {
        $questions = $this->questionRepository->findByCustom(
           $getQuestionsRequest->tagged()
        );

        return new QuestionCollectionResponse($questions);
    }
}