@extends('comm')

@section('content')
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<form role="form" enctype="multipart/form-data" method="post" >
				<div class="form-group">
					 <label for="exampleInputFile">请选择文件</label>
					 <input type="file" id="exampleInputFile" name="file"  />
				</div>
				 <input type="submit" name="sub" value="导入" class="btn btn-default">
				 <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
			</form>
		</div>
	</div>
</div>
@endsection