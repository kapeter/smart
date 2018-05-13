@php 
	$action = new $action($dataType, $data); 
	$user = Auth::user();
@endphp

@if ($action->shouldActionDisplayOnDataType())
    @can($action->getPolicy(), $data)
    	@if ($action->getPolicy() == 'read')
        <a href="{{ $action->getRoute($dataType->name) }}" title="{{ $action->getTitle() }}" {!! $action->convertAttributesToHtml() !!}>
            <i class="{{ $action->getIcon() }}"></i> <span class="hidden-xs hidden-sm">{{ $action->getTitle() }}</span>
        </a>
        @else
        	@if ($user->role_id != 2 || $user->unit_id == $data->unit_id)
	        <a href="{{ $action->getRoute($dataType->name) }}" title="{{ $action->getTitle() }}" {!! $action->convertAttributesToHtml() !!}>
	            <i class="{{ $action->getIcon() }}"></i> <span class="hidden-xs hidden-sm">{{ $action->getTitle() }}</span>
	        </a>      
	        @endif
	    @endif  		
    @endcan
@endif