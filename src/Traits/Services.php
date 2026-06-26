<?php

namespace Composite\TecDoc\Traits;

use Composite\TecDoc\Services\Addresses;
use Composite\TecDoc\Services\Articles;
use Composite\TecDoc\Services\AssemblyGroups;
use Composite\TecDoc\Services\LinkageTarget;
use Composite\TecDoc\Services\Manufacturers;
use Composite\TecDoc\Services\ModelSeries;
use Composite\TecDoc\Services\Vehicles;

trait Services
{
    /**
     * @return Manufacturers
     */
    public function manufacturers(): Manufacturers
    {
        return new Manufacturers;
    }
        
    /**
     * @return ModelSeries
     */
    public function modelSeries(): ModelSeries
    {
        return new ModelSeries;
    }

    /**
     * @return Vehicles
     */
    public function vehicles(): Vehicles
    {
        return new Vehicles;
    }

    /**
     * @return Articles
     */
    public function articles(): Articles
    {
        return app(Articles::class);
    }

    /**
     * @return Addresses
     */
    public function addresses(): Addresses
    {
        return new Addresses;
    }

    /**
     * @return AssemblyGroups
     */
    public function assemblyGroups(): AssemblyGroups
    {
        return new AssemblyGroups;
    }

    /**
     * @return LinkageTarget
     */
    public function linkageTargets(): LinkageTarget
    {
        return app(LinkageTarget::class);
    }
}