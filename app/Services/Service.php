<?php

namespace App\Services;

class Service
{
    protected $end_point_slug, $wrapper_class, $module_name;
    protected $actions = ['edit', 'delete'];

    public function createEntity($params)
    {
        return $this->wrapper_class->curlRequest($this->end_point_slug, '', 'POST', $params);
    }

    public function updateEntity($params)
    {
        return $this->wrapper_class->curlRequest($this->end_point_slug, '/' . $params['id'], 'PUT', $params);
    }

    public function getSingleEntity($id)
    {
        return $this->wrapper_class->curlRequest($this->end_point_slug, '/' . $id, 'GET')->data;
    }

    public function deleteEntity($id)
    {
        return $this->wrapper_class->curlRequest($this->end_point_slug, '/' . $id, 'DELETE');
    }

    public function getAllEntities($request_params)
    {
        $params = '?limit=' . $request_params['length'] . '&offset=' . $request_params['start'];

        if ($request_params['search']['value']) {

            $params = $params . '&search=' . $request_params['search']['value'];
        }

        $data = $this->wrapper_class->curlRequest($this->end_point_slug, $params, 'GET');

        foreach ($data->data->docs as &$doc) {

            $doc->action = $this->makeTableActionButtons($doc);
        }

        return [
            'draw' => $request_params['draw'],
            'iTotalRecords' => $data->data->total_docs,
            'iTotalDisplayRecords' => $data->data->total_docs_with_filter,
            'data' => $data->data->docs
        ];
    }

    protected function makeTableActionButtons($row)
    {
        $buttons = $this->customActionButtons();

        $actions = $this->actions;

        return view('includes.datatable_buttons', compact('buttons', 'actions', 'row'))->render();
    }

    protected function customActionButtons()
    {
        return [
            'edit' => ['route' => $this->module_name . '_edit'],
            'delete' => ['route' => $this->module_name . '_delete'],
            'view' => ['route' => $this->module_name . '_view']
        ];
    }
}
