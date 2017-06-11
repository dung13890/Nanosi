@if (@isset($type))
  @if ($type == 'dismissible')
    <div class="alert alert-{{ $level or 'success' }} alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="alert-title">{!! $title !!}</div>
      {{ $slot }}
    </div>
  @endif
  @if ($type == 'links')
    <div class="alert alert-{{ $level or 'success' }}" role="alert">
      <a href="{{ $url or '#' }}" class="alert-link">{!! $title !!}</a>
      {{ $slot }}
    </div>
  @endif
@else
    <div class="alert alert-{{ $level or 'success' }}">
      <div class="alert-title">{!! $title !!}</div>
      {{ $slot }}
    </div>
@endif
