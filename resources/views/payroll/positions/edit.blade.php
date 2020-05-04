
<form action="#" method="put" data-url="{{ route('positions.update',$position->getId()) }}" id="formCreate">
    {{--    <input type="text" name="rol_id" value="" id="rol_id">--}}
    <div class="form-body">

        <div class="col col-sm-8 col-md-7">
            <label class="label" for="name">Nombre del puesto :</label>
            <div class="form-group">
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ $position->getName() }}"
                       class="form-control {{ $errors->has('name') ? 'border-danger':'' }} ">

                <div class="col-md-12 text-danger">
                    {{ $errors->first('name') }}
                </div>
            </div>
        </div>
        <div class="col col-md-5">
            <label class="label" for="name">Codigo :</label>
            <div class="form-group">
                <input type="text"
                       id="code"
                       name="code"
                       value="{{ $position->getCode() }}"
                       class="form-control {{ $errors->has('code') ? 'border-danger':'' }} ">
                <div class="col-md-12 text-danger">
                    {{ $errors->first('code') }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <label class="label" for="lob">Descripcion :</label>
            <div class="form-group">
            <textarea type="tex"
                      id="desc"
                      name="desc"
                      class="form-control {{ $errors->has('lob') ? 'border-danger':'' }} ">{{$position->getDesc()}}</textarea>
                <div class="col-md-12 text-danger">
                    {{ $errors->first('lob') }}
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="row">
                <label class="btn">
                    <input type="checkbox"
                           name="chief"
                           {{ $position->reqChief() ? 'checked':'' }}
                           id="cbox1"
                           value="cbox1"> Tiene superior</label>
            </div>
            <div class="row">
                <label class="btn">
                    <input type="checkbox"
                           id="subs"
                           {{ $position->hasSubs() ? 'checked':'' }}
                           value="cbox2"> Tiene sub-alternos
                </label>
            </div>

        </div>
        <div class="col-md-6">
            <div class="row">
                <label class="btn">
                    <input type="checkbox"
                           {{ $position->reqDep() ? 'checked':'' }}
                           id="depa"
                           value=""> Requiere department
                </label>
            </div>
            <div class="row">
                <label class="btn">
                    <input type="checkbox"
                           {{ $position->reqArea() ? 'checked':'' }}
                           id="area"
                           value="cbox3"> Tienen un area
                </label>
            </div>
        </div>
    </div>

    <div class="form-actions right" style="padding: 10px;">
        <button type="button"
                onclick="loadCardAjax('{{route('positions.create')}}',$('#card_position'))"
                class="btn btn-red"
                data-dismiss="modal">Cancelar</button>
        <button type="button"
                form="formCreate"
                onclick="loadCardPostAjax($('#formCreate'),$('#card_position'))"
                class="btn btn-green">Aregar</button>
    </div>
</form>
