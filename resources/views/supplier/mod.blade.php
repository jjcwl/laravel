<!-- <html>
<head></head>
<body>
	<form>
		发运站点：<input type="text" name="s_site" value="{{$data->s_site}}"><br>
		煤种：<input type="text" name="s_seed" value="{{$data->s_seed}}"><br>
		年发运量：<input type="text" name="s_volume" value="{{$data->s_volume}}"><br>
		<input type="submit" name="sub" value="修改">
		<input type="hidden" name="hid" value="{{$data->s_id}}">
	</form>
</body>
</html> -->
@extends('comm')

@section('content')
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<form role="form">
				<div class="form-group">
					 <label for="exampleInputEmail1">发运站点</label><input type="text" class="form-control" id="exampleInputEmail1" name="s_site" value="{{$data->s_site}}"/>
				</div>
				<div class="form-group">
					 <label for="exampleInputPassword1">煤种</label><input type="text" class="form-control" id="exampleInputPassword1" name="s_seed" value="{{$data->s_seed}}"/>
				</div>
				<div class="form-group">
					 <label for="exampleInputPassword1">年发运量</label><input type="text" class="form-control" id="exampleInputPassword1" name="s_volume" value="{{$data->s_volume}}" />
				</div>
 			<input type="submit" name="sub" class="btn btn-default" value="修改">
 			<input type="hidden" name="hid" value="{{$data->s_id}}">
			</form>
		</div>
	</div>
</div>
@endsection