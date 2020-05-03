@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', 'register-page')

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ $dashboard_url }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
            <p class="login-box-msg">{{ __('adminlte::adminlte.register_message') }}</p>
            <form action="{{ $register_url }}" method="post">
                {{ csrf_field() }}
                <!-- Nombre -->
                <div class="input-group mb-3">
                    <input type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" value="{{ old('nombre') }}"
                           placeholder="{{ __('adminlte::adminlte.name') }}" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class=""></span>
                        </div>
                    </div>

                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </div>
                    @endif
                </div>
                <!-- Apellido -->
                <div class="input-group mb-3">
                    <input type="text" name="apellido" class="form-control {{ $errors->has('apellido') ? 'is-invalid' : '' }}" value="{{ old('apellido') }}"
                           placeholder="{{ __('adminlte::adminlte.lastname') }}" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class=""></span>
                        </div>
                    </div>

                    @if ($errors->has('apellido'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('apellido') }}</strong>
                        </div>
                    @endif
                </div>
                <!-- Usuario -->
                <div class="input-group mb-3">
                    <input type="text" name="nombreUsuario" class="form-control {{ $errors->has('nombreUsuario') ? 'is-invalid' : '' }}" value="{{ old('nombreUsuario') }}"
                           placeholder="{{ __('adminlte::adminlte.username') }}" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>

                    @if ($errors->has('nombreUsuario'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('nombreUsuario') }}</strong>
                        </div>
                    @endif
                </div>
                <!-- Tipo Usuario -->
                <div class="input-group mb-3">
                    <select name="tipoUsuario" id="tipoUsuario" class=" form-control {{ $errors->has('tipoUsuario') ? 'is-invalid' : '' }}" value="{{ old('tipoUsuario') }}"">
                        <option value="" hidden dissabled>Tipo de Usuario</option>
                        <option value="calidad">Control de Calidad</option>
                        <option value="laboratorio">Laboratorio</option>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-flask"></span>
                        </div>
                    </div>
                    @if ($errors->has('tipoUsuario'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('tipoUsuario') }}</strong>
                        </div>
                    @endif
                </div>
                <!-- Contraseña -->
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="{{ __('adminlte::adminlte.password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                           placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </div>
                    @endif
                </div>
                <!-- Submit -->
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    {{ __('adminlte::adminlte.register') }}
                </button>
            </form>
            <!-- Login -->
            <p class="mt-2 mb-1">
                <a href="{{ $login_url }}">
                <i class="fa fa-angle-double-left"></i> {{ __('adminlte::adminlte.back_to_login') }}
                </a>
            </p>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
