<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;

use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class TestController extends AbstractController
{
    private $articleRepository;
    public function __construct(CategoryRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    #[Route('/chart', name: 'app_chart')]
    public function chartjs(): Response
    {
        return $this->render('test/chart.html.twig', []);
    }
    #[Route('/counter', name: 'app_counter')]
    public function counter(): Response
    {
        return $this->render('test/counter.html.twig', []);
    }

    #[Route('/test2', name: 'app_test2')]
    public function test2(): Response
    {

        $data = [
            'labels' => ['Janvier', 'Février', 'Mars', 'Avril', 'Mai'],
            'datasets' => [
                [
                    'label' => 'Articles publiés',
                    'backgroundColor' => '#36A2EB',
                    'data' => [12, 19, 3, 5, 2],
                ],
                [
                    'label' => 'Utilisateurs actifs',
                    'backgroundColor' => '#FFCE56',
                    'data' => [8, 15, 5, 2, 9],
                ],
            ],
        ];


        // $chart = new Chart(Chart::TYPE_BAR);
        // $chart->setData($data);

        return $this->render('test/test2.html.twig', [
            'controller_name' => 'TestController',
            'chart' => '$chart',

        ]);
    }
}
