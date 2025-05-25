@extends('layouts.app')

@section('title', 'Contact Us')
<!-- <h2>Pattern Generator</h2> --> <h2 class="text-center mb-3 fw-bold text-success">PATTERN</h2>
<br>
<pre>
@php

    for ($i = 0; $i <= $rows; $i++) {
        echo "*";  
        for ($j = 0; $j < $i - 1; $j++) {
            echo "_"; 
        }
        if ($i > 0) {
            echo "*";  
        }
        echo "\n"; 
    }
    echo str_repeat('*', $rows + 1) . "\n";  
@endphp
</pre>