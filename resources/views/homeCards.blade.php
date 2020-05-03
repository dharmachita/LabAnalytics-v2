

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <a href="{{url('/reparaciones')}}">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-cogs"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Equipos en Reparación</span>
                            <p class="number-home">
                            @if($reparaciones>0)    
                                {{$reparaciones}}
                            @else
                                -
                            @endif    
                            </p>
                            <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description progress-text">
                            Ver más...
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="#">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-balance-scale"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Sometidos a Calibración</span>
                            <p class="number-home">
                            @if($calibrables>0)    
                                {{$calibrables}}
                            @else
                                -
                            @endif
                            </p>
                            <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description progress-text">
                            Ver más...
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="#">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Próxima Calibración de Equipos</span>
                            <p class="number-home">25/05/2020</p>
                            <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description progress-text">
                            Ver más...
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{url('/equipos')}}">
                    <div class="info-box bg-blue">
                        <span class="info-box-icon"><i class="fa fa-info-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Cantidad de Equipos</span>
                            <p class="number-home">
                            @if($equipos>0)    
                                {{$equipos}}
                            @else
                                -
                            @endif</p>
                            <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description progress-text">
                            Ver más...
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{url('/patrones')}}">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-info-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Cantidad de Patrones</span>
                            <p class="number-home">
                            @if($patrones>0)    
                                {{$patrones}}
                            @else
                                -
                            @endif</p>
                            <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description progress-text">
                            Ver más...
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="#">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Próxima Calibración de Patrones</span>
                            <p class="number-home">30/05/2020</p>
                            <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description progress-text">
                            Ver más...
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>