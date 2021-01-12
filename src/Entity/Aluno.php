<?php
namespace App\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Entity
 */
class Aluno {
    
  /**
   * @Id
   * @Column(name="id",type="integer")
   * @GeneratedValue
   */
  private int $id;
  
  /**
   * @Column(type="string", nullable=false)
   */  
  private string $name;

  /**
   * @OneToMany(targetEntity="Telefone", mappedBy="Aluno", cascade={ "persist", "remove" })
   */
  private Collection $telefones;

  public function getId():int {
    return $this->id;
  }

  public function getName():string {
    return $this->name;
  }

  public function setName(string $name):self {
    $this->name = $name;
    return $this;
  }

  public function getTelefones():Collection {
    return $this->telefones;
  }
    
  public function setTelefone(Collection $telefones):self {
    $this->telefones = $telefones;
    return $this;
  }

  public function addTelefone(Telefone $telefone):self {
    $telefone->setAluno($this);
    $this->telefones->add($telefone);
    return $this;
  }
}