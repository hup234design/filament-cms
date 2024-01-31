<?php

namespace Hup234design\FilamentCms\Livewire\Blocks;

use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\FilamentCms\Models\Employee;

class EmployeesBlock extends ContentBlockTemplate
{
    protected static function makeFilamentSchema(): array|\Closure
    {
        return [
            //
        ];
    }

    public function render()
    {
        $employees = Employee::visible()->get();
        return view('cms::livewire.blocks.employees-block', [
            'employees' => $employees
        ]);
    }
}
