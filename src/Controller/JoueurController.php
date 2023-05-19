<?php

namespace App\Controller;

use App\Entity\Joueur;
use App\Entity\Vote;
use App\Form\VoteType;
use App\Repository\JoueurRepository;
use App\Repository\VoteRepository;
use Container21H1paU\get_Maker_AutoCommand_MakeVoter_LazyService;
use Container21H1paU\getManagerRegistryAwareConnectionProviderService;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JoueurController extends AbstractController
{
    #[Route('/joueur', name: 'app_joueur')]
    public function showAllProduct(JoueurRepository $joueurRepository,ManagerRegistry $doctrine,Request $request): Response
    {
        $joueurs = $joueurRepository->orderByNOM();
        $vote = new Vote();
        $form = $this->createForm(VoteType::class,$vote);
        $form->handleRequest($request);
        $em = $doctrine->getManager();
        if($form->isSubmitted()) {
            $vote->setDate(new \DateTime());
            $em->persist($vote);
            $em->flush();
            return $this->redirectToRoute('app_joueur');
        }
        return $this->renderForm('joueur/list.html.twig', [
            'joueurs' => $joueurs,
            'form'=>$form
        ]);
    }


}
