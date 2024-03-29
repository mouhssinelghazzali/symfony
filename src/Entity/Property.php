<?php

namespace App\Entity;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Componen;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 * @UniqueEntity("title")
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Imagegalerie", inversedBy="properties")
     */
    private $gallery;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="property", orphanRemoval=true, cascade={"persist"})
     */
    private $pictures;


      /**
     * @Assert\All({
     *   @Assert\Image(mimeTypes="image/*")
     * })
     */
     private $pictureFiles;

     /**
      * @ORM\Column(type="float", scale=4 , precision= 6)
      */
     private $lat;

     /**
      * @ORM\Column(type="float", scale=4, precision= 7)
      */
     private $lng;

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
        $this->updated_at = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        
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
        return $this->updated_at;
    }

    public function setupdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

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

    public function getGallery(): ?Imagegalerie
    {
        return $this->gallery;
    }

    public function setGallery(?Imagegalerie $gallery): self
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * @return Collection|picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }


    public function getPicture(): ?Picture
    {

        if ($this->pictures->isEmpty()) {
            return null;
        }
            return $this->pictures->first();    

        

    }
     /**
     * @return mixed
     */
     public function getPictureFiles()
     {
         return $this->pictureFiles;
     }
 
     /**
      * @param mixed $pictureFiles
      * @return Property
      */
     public function setPictureFiles($pictureFiles): self
     {
         foreach($pictureFiles as $pictureFile) {
             $picture = new Picture();
             $picture->setImageFile($pictureFile);
             $this->addPicture($picture);
         }
         $this->pictureFiles = $pictureFiles;
         return $this;
     }
     
    public function addPicture(picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProperty($this);
        }

        return $this;
    }

    public function removePicture(picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getProperty() === $this) {
                $picture->setProperty(null);
            }
        }

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }
  
}
