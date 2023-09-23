<?php
// src/Service/ChartDataService.php

namespace App\Service;

class ChartDataService
{
    public function getChartData(): array
    {
        // Générez des données pour le graphique, par exemple, un tableau associatif
        // avec des étiquettes de catégories et des valeurs numériques.
        return [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            'data' => [12, 19, 3, 5, 2],
        ];
    }
}