<?php
namespace APP\Media;

Class Media{
    private string $FilaName;
    private int $size;
    private string $extention;


    /**
     * Get the value of FilaName
     */ 
    public function getFilaName()
    {
        return $this->FilaName;
    }

    /**
     * Set the value of FilaName
     *
     * @return  self
     */ 
    public function setFilaName($FilaName)
    {
        $this->FilaName = $FilaName;

        return $this;
    }

    /**
     * Get the value of size
     */ 
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */ 
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of extention
     */ 
    public function getExtention()
    {
        return $this->extention;
    }

    /**
     * Set the value of extention
     *
     * @return  self
     */ 
    public function setExtention($extention)
    {
        $this->extention = $extention;

        return $this;
    }
}