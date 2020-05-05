<?php

namespace App\Soap;

use App\Entity\Secteur;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;

class SoapClass
{
    private $_em;
    private $logger;

    public function __construct(EntityManager $entityManager, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->_em = $entityManager;
    }

    /**
     * Dis "Hello" à la personne passée en paramètre
     * @param string $name Le nom de la personne à qui dire "Hello!"
     * @return string The hello string
     */
    public function sayHello(string $name) : string
    {
        return 'Hello '.$name.'!';
    }

    /**
     * Réalise la somme de deux entiers
     * @param int $a 1er nombre
     * @param int $b 2ème nombre
     * @return int La somme des deux entiers
     */
    public function sumHello(int $a, int $b) : int {
        return (int)($a+$b);
    }

    /**
     * Récupère le secteur par l'id
     * @param int $id L'id du secteur à chercher
     * @return \App\Soap\SecteurSoap Le secteur trouvé
     */
    public function getSecteurById(int $id): \App\Soap\SecteurSoap
    {
        $secteur = $this->_em->getRepository(Secteur::class)->findOneBy(["id" => $id]);
        $this->logger->warning($secteur->getLibelle());
        return new SecteurSoap($secteur->getId(), $secteur->getLibelle());
    }
}