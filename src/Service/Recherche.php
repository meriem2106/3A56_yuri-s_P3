<?php

// src/Service/ProduitSearchService.php
namespace App\Service;

use App\Repository\ProduitRepository;
use App\Service\ProduitSearchService;

class ProduitSearchService
{
    private $produitRepository;

    public function __construct(ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
    }

    public function findBySearchTerm($searchTerm)
    {
        return $this->produitRepository->findBySearchTerm($searchTerm);
    }
}
