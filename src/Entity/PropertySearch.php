<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;



class PropertySearch 
{
    /**
     *@var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     * @Assert\Range(
     *      min = 10,
     *      max = 500,
     *      minMessage = "You must be at least {{ limit }} m² tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }} m² to enter"
     * )
     */
    private $minSurface;


    /**
     * @var ArrayCollection
     */
    private $otpionns;


    public function __construct()
    {
        $this->otpionns = new ArrayCollection();
    }



    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(int $maxPrice): PropertySearch
    {
     $this->maxPrice = $maxPrice;
     return $this;
    }

    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    public function setMinSurface(int $minSurface): PropertySearch
    {
     $this->minSurface = $minSurface;
     return $this;
    }
    /**
     * @return ArrayCollection
     */
    public function getOptionns(): ArrayCollection
    {
        return $this->otpionns;
    }

    /** 
     * @param ArrayCollection $otpionns
    */

    public function setOptionns(ArrayCollection $otpionns): Void
    {
     $this->otpionns = $otpionns;
    }
    

   
}



