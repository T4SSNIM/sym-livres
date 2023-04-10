<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Repository\LivresRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivresController extends AbstractController
{

    #[Route('/admin/livres', name: 'app_livres')] //optimisation pour le code au dessous
    public function index(LivresRepository $rep): Response
    {
        $Livres= $rep->findAll();
        dd($Livres);
    }

    /*#[Route('/admin/livres', name: 'app_livres')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $rep= $doctrine->getRepository(Livres::class);
        $Livres= $rep->findAll(); //$Livres de type tab d'obj
        dd($Livres);
    }*/

    //optimisation de function chercher
    #[Route('/admin/livres/find/{id}', name: 'app_livres_find_id')]
    public function chercher(Livres $livre): Response
    {
        dd($livre);
    }

    /*#[Route('/admin/livres/find/{id}', name: 'app_livres_find_id')]
    public function chercher($id, ManagerRegistry $doctrine): Response
    {
        $rep= $doctrine->getRepository(Livres::class);
        $Livre= $rep->find($id); //$Livre de type d'obj
        dd($Livre);
    }*/


    #[Route('/admin/livres/add', name: 'app_livres_add')]
    public function add(ManagerRegistry $doctrine): Response
    {
        $livre=new Livres();
        $date= new \DateTime('2022-04-01');
            $livre->setLibelle('Réseaux locaux');
            $livre->setResume('Résumé résaux');
            $livre->setImage('https://via.placeholder.com/300');
            $livre->setPrix(180);
            $livre->setEditeur('DUNOD');
            $livre->setDateEdition($date);

            $em=$doctrine->getManager();
            $em->persist($livre);
            $em->flush();
            dd($livre);
    }


    #[Route('/admin/livres/update/{id}', name: 'app_livres_update_id')]
    public function update_price($id, ManagerRegistry $doctrine): Response
    {
        $rep= $doctrine->getRepository(Livres::class);
        $livre= $rep->find($id);
        $livre->setPrix(110);
        $em=$doctrine->getManager();
        $em->flush();
        dd($livre);
    }


    #[Route('/admin/livres/delete/{id}', name: 'app_livres_delete_id')]
    public function delete($id, ManagerRegistry $doctrine): Response
    {
        $rep= $doctrine->getRepository(Livres::class);
        $livre= $rep->find($id);
        $em=$doctrine->getManager();
        $em->remove($livre);
        $em->flush();
        dd($livre);
    }

}
