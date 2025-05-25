<!-- Pattern Generator Section -->
<div class="col-md-5">
    <div class="card h-100">
        <div class="card-body">
            <!-- <h3 class="card-title">Pattern Generator</h3> -->
            <h2 class="text-center mb-3 fw-bold text-success">PATTERN GENERATOR</h2>
            <div class="card-text">
                <pre>
                    @php
                        $s = 4; // size of the pattern
                    @endphp
                    
                    @for ($i = 1; $i <= $s; $i++)
                        @for($j = 1; $j <= $i; $j++)
                            @if($j == 1 || $i == $s || $j == $i)
                                *
                            @else
                                _
                            @endif
                        @endfor
                        <br>
                    @endfor
                </pre>
            </div>
        </div>
    </div>
</div>