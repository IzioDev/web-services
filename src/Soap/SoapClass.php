<?php

namespace App\Soap;

use App\Entity\Product;
use App\Entity\Secteur;
use App\Entity\User;
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
     * Récupère la dernière commande de l'utilisateur
     * @param int $id L'id de l'utilisateur à chercher
     * @return \App\Soap\CommandSoap La dernière commande de l'utilisateur
     */
    public function getLastCommandForUserId(int $id): \App\Soap\CommandSoap
    {
        $user = $this->_em->getRepository(User::class)->findOneBy(["id" => $id]);
        $commands = $user->getCommands();
        $this->logger->warning($commands[0]->getUser()->getEmail());

        $soapCommand = new CommandSoap();
        $soapCommand->setStatus($commands[0]->getStatus());
        $soapCommand->setCreatedAt(date_format($commands[0]->getCreatedAt(), 'Y-m-d H:i:s'));
        $soapCommand->setId($commands[0]->getId());
        return $soapCommand;
    }

    /**
     * Récupère la catégorie depuis l'id d'un produit
     * @param int $id L'id du produit à chercher
     * @return \App\Soap\CategorySoap La catégorie du produit trouvé
     */
    public function getCategorieFromProductId(int $id): \App\Soap\CategorySoap
    {
        $product = $this->_em->getRepository(Product::class)->findOneBy(["id" => $id]);
        $category = $product->getCategory();

        $soapCategorie = new CategorySoap();
        $soapCategorie->setId($category->getId());
        $soapCategorie->setImageUri($category->getImageUri());
        $soapCategorie->setDescription($category->getDescription());
        $soapCategorie->setLabel($category->getLabel());

        return $soapCategorie;
    }
}