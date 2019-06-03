<?php

namespace App\Entity;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Componen;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 * @UniqueEntity("title")
 * @Vich\Uploadable
 */
class Property
{

    const HEAT =[
        0 => 'gaz',
        1 => 'eau'
    ];
   




     /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    
    private $id;

    /**
    * @var string|null
    * @ORM\Column(type="string",length=225)
     */

    private $filename;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
     * @var File|null
     */
     private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 10,
     *      max = 400,
     *      minMessage = "You must be at least {{ limit }} m² tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }} m² to enter"
     * )
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     */
    private $rooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $bedrooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $floor;

    /**
     * @ORM\Column(type="integer")
     */
    private $heat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[0-9]{5}$/")
     */
    private $postal_code;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $sold =false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Optionn", inversedBy="properties")
     */
    private $optionns;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
   
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getHeat(): ?int
    {
        return $this->heat;
    }

    public function setHeat(int $heat): self
    {
        $this->heat = $heat;

        return $this;
    }

    public function getHeatType(): string
    {
        return self::HEAT[$this->heat];

    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->addresse;
    }

    public function setAdresse(string $addresse): self
    {
        $this->addresse = $addresse;

        return $this;
    }

    /**
     * @return null|string
     * 
     */

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     * @return Property
     */
    public function setFilename(?string $filename): Property
    {
        $this->filename = $filename;

        return $this;
    }

/**
     * @return null|string
     * 
     */
      public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }   

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getSolde(): ?bool
    {
        return $this->sold;
    }

    public function setSolde(bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }
    
    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->optionns = new ArrayCollection();
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
    public function getupdatedAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setupdatedAt(\DateTimeInterface $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }
    public function getFormatedPrice():string
    {
        return number_format($this->price,0,'',' ');
        

    }
    
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
    public function getSlug(): string
    {
      $slugify = new Slugify();
      return( $slugify->slugify($this->title)); 
    }

    /**
     * @return Collection|Optionn[]
     */
    public function getOptionn(): Collection
    {
        return $this->optionns;
    }

    public function addOptionn(Optionn $optionn): self
    {
        if (!$this->optionns->contains($optionn)) {
            $this->optionns[] = $optionn;
            $optionn->addProperty($this);
        }

        return $this;
    }

    public function removeOptionn(Optionn $optionn): self
    {
        if ($this->optionns->contains($optionn)) {
            $this->optionns->removeElement($optionn);
            $optionn->removeProperty($this);
        }

        return $this;
    }
  
}
