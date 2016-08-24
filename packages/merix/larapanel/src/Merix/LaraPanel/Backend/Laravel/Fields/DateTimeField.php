<?php

namespace Merix\LaraPanel\Backend\Laravel\Fields;


use Merix\LaraPanel\Backend\Laravel\Utils\Convert;

class DateTimeField extends Field
{
    protected $date;
    protected $time;
    protected $showTimezone;
    protected $storeTimezone;

    protected function init()
    {
        parent::init();
        $this->date = $this->getConfigValue('date');
        $this->time = $this->getConfigValue('time');
        $this->showTimezone = $this->getConfigValue('show');
        $this->storeTimezone = $this->getConfigValue('store');
    }

    protected function getDefaultParameters()
    {
        return array_merge(parent::getDefaultParameters(), [
            'date' => true,
            'time' => true,
            'show' => 'local',
            'store' => 'utc',
        ]);
    }

    public function getType()
    {
        return 'datetime';
    }

    protected function doGet()
    {
        // TODO: Solve problem with date being set to current if only time matters
        $data = $this->getObject()->{$this->getField()};

        if($data instanceof \DateTime)
            return $data;

        if(is_string($data))
            return new \DateTime($data);

        return null;
    }

    protected function doSet($value)
    {
        $this->getObject()->{$this->getField()} = $value;
    }

    public function getStructure()
    {
        $structure = parent::getStructure();
        $structure['date'] = $this->date;
        $structure['time'] = $this->time;
        $structure['show'] = $this->showTimezone;
        return $structure;
    }

    /**
     * @param $data \DateTime
     * @return array
     */
    public function serialize($data)
    {
        return [
            'name' => $this->getName(),
            'value' => $data->format('Y.m.d H:i:s'),
        ];
    }

    public function deserialize($data)
    {
        if(!isset($data['value']))
            return null;

        return \DateTime::createFromFormat('Y.m.d H:i:s', $data['value']);
    }


}