<?php

function ui_class_names(...$classes) {
    return implode(' ', array_filter($classes));
}

function ui_button(string $text, string $type = 'primary', string $icon = '', array $attrs = []): string {
    $baseClasses = "inline-flex items-center justify-center rounded-md px-3 py-2 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 transition-colors duration-200";
    
    $types = [
        'primary' => 'bg-slate-900 text-white hover:bg-slate-800 focus-visible:outline-slate-900',
        'secondary' => 'bg-white text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50',
        'danger' => 'bg-red-600 text-white hover:bg-red-500 focus-visible:outline-red-600',
        'ghost' => 'text-gray-900 hover:bg-gray-50',
        'link' => 'text-slate-600 hover:text-slate-900 hover:underline px-0 shadow-none'
    ];
    
    $classes = ui_class_names($baseClasses, $types[$type] ?? $types['primary'], $attrs['class'] ?? '');
    unset($attrs['class']);
    
    $attrString = '';
    foreach ($attrs as $key => $val) {
        $attrString .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"';
    }
    
    $iconHtml = '';
    if ($icon) {
        $iconHtml = "<i class=\"ph ph-{$icon} mr-2 text-lg\"></i>";
    }
    
    return "<button class=\"{$classes}\"{$attrString}>{$iconHtml}{$text}</button>";
}

function ui_badge(string $status, string $label = ''): string {
    $baseClasses = "inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset";
    
    // Default styles for common statuses
    $styles = [
        'success' => 'bg-green-50 text-green-700 ring-green-600/20', // paid
        'paid' => 'bg-green-50 text-green-700 ring-green-600/20',
        'warning' => 'bg-yellow-50 text-yellow-800 ring-yellow-600/20', // pending
        'pending' => 'bg-yellow-50 text-yellow-800 ring-yellow-600/20',
        'danger' => 'bg-red-50 text-red-700 ring-red-600/20', // overdue
        'overdue' => 'bg-red-50 text-red-700 ring-red-600/20',
        'info' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
        'gray' => 'bg-gray-50 text-gray-600 ring-gray-500/10',
        'neutral' => 'bg-gray-50 text-gray-600 ring-gray-500/10'
    ];
    
    $class = $styles[$status] ?? $styles['gray'];
    $displayLabel = $label ?: ucfirst($status);
    
    return "<span class=\"{$baseClasses} {$class}\">{$displayLabel}</span>";
}

function ui_input(string $name, string $label, string $type = 'text', string $value = '', array $attrs = []): string {
    $id = $attrs['id'] ?? $name;
    $required = !empty($attrs['required']) ? '<span class="text-red-500">*</span>' : '';
    
    // Extract class if present to append
    $extraClass = $attrs['class'] ?? '';
    unset($attrs['class']);
    
    $attrString = " name=\"{$name}\" type=\"{$type}\" id=\"{$id}\" value=\"" . htmlspecialchars((string)$value) . "\"";
    foreach ($attrs as $key => $val) {
        $attrString .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"'; // Boolean attrs like required handled by key="val" or simple convention
    }
    
    $inputClass = "block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6 " . $extraClass;
    
    return "
    <div class=\"mb-4\">
        <label for=\"{$id}\" class=\"block text-sm font-medium leading-6 text-gray-900 mb-1\">{$label} {$required}</label>
        <div class=\"mt-2\">
            <input class=\"{$inputClass}\"{$attrString}>
        </div>
    </div>
    ";
}
