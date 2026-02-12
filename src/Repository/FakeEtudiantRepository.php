<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Etudiant;

final class FakeEtudiantRepository implements RepositoryInterface
{
    /** @var Etudiant[] */
    private $data = [];

    /** @var int */
    private $autoIncrement = 1;

    /** @return Etudiant[] */
    public function findAll(): array
    {
        return array_values($this->data);
    }

    /** @return Etudiant|null */
    public function findById(int $id)
    {
        return isset($this->data[$id]) ? $this->data[$id] : null;
    }

    /** @param Etudiant $entity */
    public function save($entity): void
    {
        if (!($entity instanceof Etudiant)) {
            throw new \InvalidArgumentException("Type non supporté : Etudiant attendu.");
        }

        if ($entity->getId() === null) {
            $entity->setId($this->autoIncrement);
            $this->data[$this->autoIncrement] = $entity;
            $this->autoIncrement++;
            return;
        }

        $this->data[$entity->getId()] = $entity;
    }

    public function delete(int $id): void
    {
        if (isset($this->data[$id])) {
            unset($this->data[$id]);
        }
    }
}
