@component('backend._partials.components.box', [
    'box_class' => 'box-solid',
    'box_title' => __('repositories.category'),
    'box_body_class' => 'no-padding',
])
@slot('box_fields')

<div class="slim-scroll">
    <ul class="nav nav-stacked">
        @foreach ($rootCategories as $rootCategory)
        <?php
            $checked = (isset($item) && isset($item->categories->keyBy('id')[$rootCategory->id])) ? true : false;
        ?>
        @if ($loop->first) <?php $checked = true ?> @endif
        <li>
            <div class="container-fluid checkbox">
                <label>
                    {{ Form::checkbox('category_ids[]', $rootCategory->id, $checked, ['class' => 'parent']) }} <b>{{ $rootCategory->name }}</b>
                </label>
            </div>
            @if (count($rootCategory->children))
                @foreach ($rootCategory->children as $childrenCategory)
                <?php
                    $childrenChecked = (isset($item) && isset($item->categories->keyBy('id')[$childrenCategory->id])) ? true : false;
                ?>
                <div class="container-fluid checkbox">
                    <label>
                        {{ Form::checkbox('category_ids[]', $childrenCategory->id, $childrenChecked, ['class' => 'children', 'data-parent' => $rootCategory->id]) }} - - {{ $childrenCategory->name }}
                    </label>
                </div>
                @endforeach
            @endif
        </li>
        @endforeach
    </ul>
</div>

@endslot
@endcomponent

@push('prescripts')
<script>
    $(function () {
        $('.slim-scroll').slimscroll({
            height: 300
        });

        $(':checkbox[class="children"]').change(function() {
            if($(this).is(":checked")) {
                var parentId = $(this).data('parent');
                if (! $(':checkbox[class="parent"][value=' + parentId + ']').is(':checked')) {
                    $(':checkbox[class="parent"][value=' + parentId + ']').prop('checked','true');
                }
            }
        });
    })
</script>
@endpush
