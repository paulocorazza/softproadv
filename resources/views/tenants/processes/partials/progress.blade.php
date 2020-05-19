<div class="progress progress-sm">
    <div class="progress-bar bg-green" role="progressbar" aria-volumenow="{{ $percent ?? 0 }}" aria-volumemin="0" aria-volumemax="100"
         style="width: {{ $percent ?? 0 }}%">
    </div>
</div>
<small>
    {{ $percent ?? 0}}% Completo
</small>
