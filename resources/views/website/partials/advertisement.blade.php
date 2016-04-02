@if($advertisement)
    <div class="avertensie" style="background: url({{ uploaded_images_url($advertisement->image) }}) no-repeat center top;">
        <div class="box">
            <a href="{{ $advertisement->action_link }}" class="btn_1 white" target="_blank">
                {{ $advertisement->action_title }}
            </a>
            <h4 class="whitee">{!! $advertisement->title !!}</h4>
            <p class="whitee">{!! $advertisement->content !!}</p>
        </div>
    </div>
@endif