<?php
namespace LaravelViews\Macros;

use Livewire\Testing\TestableLivewire;

class LaravelViewsTestMacros
{
    public function register()
    {
        TestableLivewire::macro('assertShowSuccessAlert', function ($message = null) {
            $this->assertEmitted('notify', [
                'message' => $message ?? __('Action was executed successfully'),
                'type' => 'success'
            ]);

            return $this;
        });

        TestableLivewire::macro('assertShowErrorAlert', function ($message = null) {
            $this->assertEmitted('notify', [
                'message' => $message ?? __('There was an error executing this action'),
                'type' => 'danger'
            ]);

            return $this;
        });

        TestableLivewire::macro('executeAction', function ($actionClass, $model = null) {
            $action = new $actionClass;
            $id = $model ? (is_numeric($model) ? $model : $model->getKey()) : null;
            $this->call('executeAction', $action->getId(), $id);

            return $this;
        });

        TestableLivewire::macro('confirmAction', function ($actionClass, $model = null) {
            $action = new $actionClass;
            $id = $model ? is_numeric($model) ? $model : $model->getKey() : null;
            $this->call('confirmAndExecuteAction', $action->getId(), $id);

            return $this;
        });

        TestableLivewire::macro('executeBulkAction', function ($actionClass) {
            $action = new $actionClass;
            $this->call('executeBulkAction', $action->getid());

            return $this;
        });

        TestableLivewire::macro('selectAll', function () {
            $this->set('allSelected', true);

            return $this;
        });
    }
}
