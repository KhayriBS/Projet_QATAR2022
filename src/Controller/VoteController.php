<?php

namespace App\Controller;

use App\Repository\JoueurRepository;
use App\Repository\VoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoteController extends AbstractController
{
    #[Route('/vote', name: 'app_vote')]
    public function index(): Response
    {
        return $this->render('vote/index.html.twig', [
            'controller_name' => 'VoteController',
        ]);
    }
    #[Route('/vote/byJoueur/{id}', name: 'app_vote_byjoueur')]
    public function showProductByCategory(VoteRepository $repository,$id,JoueurRepository $repo): Response
    {
        $votes = $repository->getVotesByJoueur($id);
        $joueur = $repo->find($id);
        return $this->render('vote/detailvote.html.twig', [
            'votes' => $votes,
            'joueur'=>$joueur
        ]);
    }}
