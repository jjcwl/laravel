
<!-- banner start -->
<div class="banner" id="tab" style="position:relative;">
	@foreach($banner as $val)
    <div class="banner-scroll" style="background:url({{asset('uploads'.'/'.$val->banners) }}) center center no-repeat;width:100%;height:100%;background-size:cover;">
    </div>
		<!--img src="{{asset('uploads'.'/'.$val->banners) }}"-->
	@endforeach
	<ul class="left">
		<li class="leftImg"></li>
	</ul>
	<ul class="right">
		<li class="rightImg"></li>
	</ul>
</div>