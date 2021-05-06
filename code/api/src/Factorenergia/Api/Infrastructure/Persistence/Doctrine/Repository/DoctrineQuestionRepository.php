<?php


namespace Factorenergia\Api\Infrastructure\Persistence\Doctrine\Repository;

use Factorenergia\Api\Domain\Model\Question\QuestionCollection;
use Factorenergia\Api\Domain\Model\Question\QuestionRepository;
use Factorenergia\Api\Domain\Model\Question\Question;
use Factorenergia\Api\Domain\Model\Question\QuestionId;
use Factorenergia\Api\Infrastructure\Persistence\Doctrine\Entity\Question as QuestionEntity;

class DoctrineQuestionRepository extends DoctrineRepository implements QuestionRepository
{
    protected function entityClassName(): string
    {
        return QuestionEntity::class;
    }

    public function findByCustom(string $title, string $tag, string $link): QuestionCollection
    {
        $questions = $this->repository->findBy([
            'tag' => $tag,
            'title' => $title,
            'link' => $link,
        ]);

        $questionsCollection = QuestionCollection::init();
        
        if(!empty($questions)){
            foreach ($questions as $question){
                $questionsCollection->add($this->toDomain($question));
            }
        }

        return $questionsCollection;
    }

    public function insert(Question $question): void
    {
        $this->entityManager->persist($this->toInfrastructure($question));
        $this->entityManager->flush();
    }

    private function toInfrastructure(Question $question): QuestionEntity
    {
        return new QuestionEntity(
            $question->id()->value(),
            $question->title(),
            $question->link(),
            $question->tag(),
            $question->createdAt(),
            $question->updatedAt()
        );
    }

    private function toDomain(QuestionEntity $question): Question
    {
        return new Question(
            new QuestionId($question->id()),
            $question->title(),
            $question->link(),
            $question->tag(),
            $question->createdAt(),
            $question->updatedAt()
        );
    }


}