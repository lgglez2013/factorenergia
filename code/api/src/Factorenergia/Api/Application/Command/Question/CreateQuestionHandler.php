<?php


namespace Factorenergia\Api\Application\Command\Question;


use Factorenergia\Api\Application\Request\Question\CreateQuestionRequest;
use Factorenergia\Api\Application\Response\Question\QuestionResponse;
use Factorenergia\Api\Domain\Model\Question\Status;
use Factorenergia\Api\Domain\Model\Question\Question;
use Factorenergia\Api\Domain\Model\Question\QuestionId;
use Factorenergia\Api\Domain\Model\Question\QuestionRepository;
use Factorenergia\Api\Domain\Service\IdStringGenerator;

class CreateQuestionHandler
{
    private QuestionRepository $questionRepository;
    private IdStringGenerator $idStringGenerator;

    public function __construct(QuestionRepository $questionRepository, IdStringGenerator $idStringGenerator)
    {
        $this->questionRepository = $questionRepository;
        $this->idStringGenerator = $idStringGenerator;
    }


    public function __invoke(CreateQuestionRequest $createQuestionRequest): ?QuestionResponse
    {
        $questionInLocal = $this->questionRepository->findByCustom(
            $createQuestionRequest->title(),
            $createQuestionRequest->tag(),
            $createQuestionRequest->link()
        );

        if($questionInLocal->isEmpty()){
            $question = new Question(
                new QuestionId($this->idStringGenerator->generate()),
                $createQuestionRequest->title(),
                $createQuestionRequest->link(),
                $createQuestionRequest->tag()
            );

            $this->questionRepository->insert($question);

            return new QuestionResponse($question);
        }

        return null;
    }
}