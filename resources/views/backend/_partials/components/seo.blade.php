<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#seo_title" data-toggle="tab">TIT</a></li>
        <li><a href="#seo_description" data-toggle="tab">DES</a></li>
        <li><a href="#seo_keywords" data-toggle="tab">KEY</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="seo_title">
            <div class="form-group">
                {{ Form::label('seo_title', 'Title', ['class' => 'control-label']) }}
                {{ Form::text('seo_title', (isset($seo) && $seo) ? $seo->title : null, ['class' => 'form-control', 'placeholder' => 'Title SEO']) }}
            </div>
        </div>
        <div class="tab-pane" id="seo_description">
            <div class="form-group">
                {{ Form::label('seo_description', 'Description', ['class'=>'control-label']) }}
                {{ Form::textarea('seo_description',(isset($seo) && $seo) ? $seo->description : null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Description SEO']) }}
            </div>
        </div>
        <div class="tab-pane" id="seo_keywords">
            <div class="form-group">
                {{ Form::label('seo_keywords', 'Keywords', ['class'=>'control-label']) }}
                {{ Form::text('seo_keywords', (isset($seo) && $seo) ? $seo->keywords : null, ['class' => 'form-control', 'placeholder' => 'keywords SEO ']) }}
            </div>
        </div>
    </div>
</div>
