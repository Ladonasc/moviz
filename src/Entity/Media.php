<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaRepository")
 */
class Media extends AbstractEntity
{

    const TYPE_DVD      = 1;
    const TYPE_BLURAY   = 2;
    const TYPE_BOTH     = 3;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $title;

    /**
     * @todo : event pour peupler cet attr avec le title avant persistence / update si vide
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $orderingTitle;

    /**
     * Many Medias as many Categories (many to many relation)
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Category")
     * @ORM\JoinTable(name="medias_categories",
     *      joinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     *      )
     *
     * @var ArrayCollection
     */
    private $categories;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string
     */
    private $summary;

    /**
     * 1 = dvd
     * 2 = bluray
     * 3 = both (bluray / dvd)
     *
     * @ORM\Column(type="smallint")
     *
     * @var integer
     */
    private $type;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     *
     * @var integer
     */
    private $releaseYear;

    /**
     * In Minutes
     *
     * @ORM\Column(type="smallint", nullable=true)
     *
     * @var integer
     */
    private $duration;

    /**
     * Many Medias as many Languages (many to many relation)
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Language")
     * @ORM\JoinTable(name="medias_languages",
     *      joinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="language_id", referencedColumnName="id")}
     *      )
     *
     * @var ArrayCollection
     */
    private $languages;

    /**
     * Many Medias as many Subtitles (many to many relation)
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Language")
     * @ORM\JoinTable(name="medias_subtitles",
     *      joinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="language_id", referencedColumnName="id")}
     *      )
     *
     * @var ArrayCollection
     */
    private $subTitles;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string
     */
    private $bonusSummary;

    /**
     * In Minutes
     *
     * @ORM\Column(type="smallint", nullable=true)
     *
     * @var integer
     */
    private $note;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string
     */
    private $comment;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var boolean
     */
    private $isSerie;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var boolean
     */
    private $isBoxed;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var boolean
     */
    private $isLent;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     * @var string
     */
    private $lentTo;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @var DateTime
     */
    private $lentSince;

    /**
     * @todo : listener pour completer ce field lors de la creation
     * @ORM\Column(type="datetime")
     *
     * @var DateTime
     */
    private $createdAt;

    /**
     * @todo : listener pour completer ce field lors de l'update
     * @ORM\Column(type="datetime")
     *
     * @var DateTime
     */
    private $updatedAt;

    public function __construct()
    {
        $this->isSerie = false;
        $this->isBoxed = false;
        $this->isLent = false;

        $this->languages = new ArrayCollection();
        $this->subTitles = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderingTitle()
    {
        return $this->orderingTitle;
    }

    /**
     * @param string $orderingTitle
     *
     * @return self
     */
    public function setOrderingTitle($orderingTitle)
    {
        $this->orderingTitle = $orderingTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     *
     * @return self
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param integer $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return integer
     */
    public function getReleaseYear()
    {
        return $this->releaseYear;
    }

    /**
     * @param integer $releaseYear
     *
     * @return self
     */
    public function setReleaseYear($releaseYear)
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param integer $duration
     *
     * @return self
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return string
     */
    public function getBonusSummary()
    {
        return $this->bonusSummary;
    }

    /**
     * @param string $bonusSummary
     *
     * @return self
     */
    public function setBonusSummary($bonusSummary)
    {
        $this->bonusSummary = $bonusSummary;

        return $this;
    }

    /**
     * @return integer
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param integer $note
     *
     * @return self
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     *
     * @return self
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsSerie()
    {
        return $this->isSerie;
    }

    /**
     * @param boolean $isSerie
     *
     * @return self
     */
    public function setIsSerie($isSerie)
    {
        $this->isSerie = $isSerie;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsBoxed()
    {
        return $this->isBoxed;
    }

    /**
     * @param boolean $isBoxed
     *
     * @return self
     */
    public function setIsBoxed($isBoxed)
    {
        $this->isBoxed = $isBoxed;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsLent()
    {
        return $this->isLent;
    }

    /**
     * @param boolean $isLent
     *
     * @return self
     */
    public function setIsLent($isLent)
    {
        $this->isLent = $isLent;

        return $this;
    }

    /**
     * @return string
     */
    public function getLentTo()
    {
        return $this->lentTo;
    }

    /**
     * @param string $lentTo
     *
     * @return self
     */
    public function setLentTo($lentTo)
    {
        $this->lentTo = $lentTo;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getLentSince()
    {
        return $this->lentSince;
    }

    /**
     * @param DateTime $lentSince
     *
     * @return self
     */
    public function setLentSince(DateTime $lentSince)
    {
        $this->lentSince = $lentSince;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function addCategory(Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    public function removeCategory(Category $category)
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function getLanguages()
    {
        return $this->languages;
    }

    public function addLanguage(Language $language)
    {
        $this->languages[] = $language;

        return $this;
    }

    public function removeLanguage(Language $language)
    {
        $this->languages->removeElement($language);

        return $this;
    }

    public function getSubTitles()
    {
        return $this->subTitles;
    }

    public function addSubTitles(Language $subTitles)
    {
        $this->subTitles[] = $language;

        return $this;
    }

    public function removeSubTitles(Language $subTitles)
    {
        $this->subTitles->removeElement($subTitles);

        return $this;
    }
}
