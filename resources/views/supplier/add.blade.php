
@extends('comm')

@section('content')
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<form role="form">
				<div class="form-group">
					 <label for="exampleInputEmail1">发运站点</label><input type="text" class="form-control" id="exampleInputEmail1" name="s_site"/>
				</div>
				<div class="form-group">
					 <label for="exampleInputPassword1">煤种</label><input type="text" class="form-control" id="exampleInputPassword1" name="s_seed" />
				</div>
				<div class="form-group">
					 <label for="exampleInputPassword1">年发运量</label><input type="text" class="form-control" id="exampleInputPassword1" name="s_volume"  />
				</div>
 			<input type="submit" name="sub" class="btn btn-default" value="添加">
			</form>
		</div>
	</div>
</div>
@endsection