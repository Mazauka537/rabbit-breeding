<div class="alerts animated bounceInUp">
    @if(count($errors->all()) != 0)
        <div class="alert alert-error">
            <button class="alert-close-button" title="закрыть уведомление"></button>
            <div class="alert__inner">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if($messages = session('message'))
        <div class="alert alert-success">
            <button class="alert-close-button" title="закрыть уведомление"></button>
            <div class="alert__inner">
                <ul>
                    @foreach($messages as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
