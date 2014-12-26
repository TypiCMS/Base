        @if (count($locales) > 1)
        <div class="clearfix">
            <div class="btn-group pull-right" id="btn-group-form-locales">
                @foreach ($locales as $locale)
                    {{ Html::langButton($locale, array('data-target' => '#' . $target .'-'. $locale, 'data-toggle' => 'tab')) }}
                @endforeach
            </div>
        </div>
        @endif
