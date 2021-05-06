<?php


namespace Factorenergia\Api\Infrastructure\Ui\Http\Controller\Questions;

use Factorenergia\Api\Application\Command\Question\CreateQuestionHandler;
use Factorenergia\Api\Application\Query\Question\GetQuestionsHandler;
use Factorenergia\Api\Application\Request\Question\CreateQuestionRequest;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetQuestionsController
{

    private GetQuestionsHandler $getQuestionsHandler;
    private CreateQuestionHandler $createQuestionHandler;

    public function __construct(GetQuestionsHandler $getQuestionsHandler, CreateQuestionHandler $createQuestionHandler)
    {
        $this->getQuestionsHandler = $getQuestionsHandler;
        $this->createQuestionHandler = $createQuestionHandler;
    }

    public function __invoke(Request $request)
    {
        try {
            // Default filter
            $queryFilter['query'] = [
                'sort' => "activity",
                'order' => 'desc',
                'site' => 'stackoverflow'
            ];

            // Get filter
            $taggedFilter = (string)$request->get('tagged', '');
            $todateFilter = (int)$request->get('todate', 0);
            $fromdateFilter = (int)$request->get('fromdate', 0);

            // Add filter
            if(''!=$taggedFilter){
                $queryFilter['query']['tagged']  = $taggedFilter;
            }
            else{
                throw new \Exception("The tagged param is mandatory");
            }

            if(0!=$fromdateFilter){
                $queryFilter['query']['fromdate']  = $fromdateFilter;
            }

            if(0!=$fromdateFilter){
                $queryFilter['query']['todate']  = $todateFilter;
            }

            // API get data
            $httpClient = HttpClient::create();
            $response = $httpClient->request(
                'GET',
            'https://api.stackexchange.com/2.2/questions',
                $queryFilter
            );

            $content = [];
            $total = 0;
            // INSERT LOCAL DATA
            if( 0 < count($response->toArray())){
                $content = $response->toArray();
                foreach ($content['items'] as $question){
                    ($this->createQuestionHandler)(new CreateQuestionRequest(
                        $question['title'],
                        $question['link'],
                        $taggedFilter
                    ));
                    $total++;
                }
            }

            $response = new JsonResponse([
                'status' => 'ok',
                'total' => $total,
                'hits' =>  $content
            ]);
        } catch (\Exception $e) {
            $response = new JsonResponse([
                'status' => 'error',
                'errorMessage' => $e->getMessage()
            ], 500);
        }

        return $response;
    }
}