<div class="col-sm-12">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Заявка #{$id}</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table req table-condensed table-hover">
                        <tbody>
                        <tr>
                            <td>Дата создания заявки:</td>
                            <td>{$date}</td>
                        </tr>
                        <tr>
                            <td>Заявитель:</td>
                            <td>{$profile->fullname}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{$profile->email}</td>
                        </tr>
                        <tr>
                            <td>Телефон:</td>
                            <td>{$profile->phone}</td>
                        </tr>
                        <tr>
                            <td>Специализация</td>
                            <td>{$specialization->name}</td>
                        </tr>
                        <tr>
                            <td>Описание</td>
                            <td>{$description}</td>
                        </tr>
                        <tr>
                            <td>Локация</td>
                            <td>{$location->name}</td>
                        </tr>
                        <tr>
                            <td>Статус</td>
                            <td>{$status->name}</td>
                        </tr>
                        </tbody>
                    </table>
                    <!--<div class="col-sm-6 col-sm-offset-6">
                        <a href="[[-~15]]?order=[[-+id]]" class="btn btn-primary pull-right">Редактировать заявку</a>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>