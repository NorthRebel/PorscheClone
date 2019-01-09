<?php include(ROOT.'/views/layouts/header.php'); ?>

<main>
<div id="TopMargin">
        <div class="container" id="myCarousel">
            <img src="/template/images/service/main.jpg" class="img-responsive img-rounded">
        </div>
    </div>

    <div class="container rad">
        <h1>Записаться на сервис</h1>
        <hr class="divider">
        <button type="button" class="btn btn-info" style="margin-bottom: 20px;" onclick="#recording">Записаться на сервис</button>
        <br>
        <div style="margin-bottom: 20px;">
            <b>Обращаем Ваше внимание на список документов, необходимых при оформлении Заказов-нарядов:</b>
        </div>
        <p>Для физических лиц</p>
        <ul>
            <li>свидетельство о регистрации автомобиля</li>
            <li>документ, удостоверяющий личность, или водительское удостоверение</li>
            <li>доверенность* на управление автомобилем, если не собственник автомобиля подписывает Заказ-наряд от своего имени (является Заказчиком)</li>
            <li>доверенность* на осуществление ремонтных работ (лучше нотариально заверенную</li>
            <li>паспорт, если Заказ-наряд от лица собственника подписывает не собственник автомобиля</li>
        </ul>
        <p>Для юридических лиц</p>
        <ul>
            <li>свидетельство о регистрации автомобиля</li>
            <li>доверенность* от организации (на фирменном бланке, заверенную подписями руководителя и главного бухгалтера, если требуется законодательством, а также печатью организации)</li>
            <li>документ, удостоверяющий личность (например, паспорт)</li>
        </ul>
        <p>*В доверенностях на осуществление ремонтных работ в автомобилях должны быть прописаны полномочия представителя передавать автомобиль на техническое обслуживание и ремонт и принимать результаты указанных работ, расписываться в Заказах-нарядах на осуществление диагностических и ремонтных работ, составлять и расписываться в Листах осмотра-приема осмотра Автомобиля, заказывать и получать от имени владельца запчасти и аксессуары к Автомобилю и др.</p>
        <p>Доверенности, выданные в порядке передоверия, должны быть нотариально удостоверены.</p>
        <p>Для Вашего удобства мы разработали типовые формы доверенностей, которые Вы можете скачать по ссылкам ниже:</p>
        <ul>
            <li><a href=""><b>форма доверенности для физических лиц</b></a></li>
            <li><a href=""><b>форма доверенности для юридических лиц</b></a></li>
        </ul>
        <p>Компания СПОРТКАР-ЦЕНТР имеет более 12 лет опыта обслуживания автомобилей марки Porsche.</p>
        <p>Мы сделаем все необходимое, чтобы Ваш Porsche стал еще более безопасным и комфортным.</p>
        <div style="background-color: beige; margin-bottom: 20px;">
            <b>Ждем Вас по следующим адресам сервисных центров:</b>
            <p>Порше Центр Рублевский</p>
            <p>Пересечение МКАД и Рублево-Успенского ш.</p>
            <p>Режим работы: с 9:00 до 21:00 ежедневно (без выходных)</p>
            <a title="Позвонить" href="tel:+74952668743">+7 (495) 266-87-43</a>
        </div>
        <p>Пожалуйста, воспользуйтесь данной формой, чтобы оставить свою запись в расписании на техническое обслуживание или ремонт Вашего автомобиля. Эта процедура существенно сократит время, необходимое для передачи автомобиля в ремонт и оптимизирует процесс самого ремонта.</p>


        <div style="padding: 10px; background-color: burlywood; margin: 5px; border-radius: 5px;">
            <form action="" class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-12 text-right">
                        <small>Поля, отмеченные знаком *, обязательны для заполнения</small>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="header">
                            <h4>Данные по собственнику автомобиля</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Обращение *</label>
                    <div class="col-sm-9 radio">
                        <label>
					            <input type="radio" name="sex" value="F" required >Госпожа
                            </label> &nbsp; &nbsp;
                        <label>
                                <input type="radio" name="sex" value="M" required >Господин
                            </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Ф.И.О. *</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <input type="text" name="lastname" value="" class="form-control input-sm" placeholder="Фамилия *" required>
                            </div>
                            <div class="col-sm-4 form-group">
                                <input type="text" name="firstname" value="" class="form-control input-sm" placeholder="Имя *" required>
                            </div>
                            <div class="col-sm-4 form-group">
                                <input type="text" name="midname" value="" class="form-control input-sm" placeholder="Отчество">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Способ связи *</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <input type="text" name="phone" value="" class="form-control input-sm" placeholder="Телефон *" required>
                            </div>
                            <div class="col-sm-4 form-group">
                                <input type="email" name="email" value="" class="form-control input-sm" placeholder="E-mail">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="header">
                            <h4>Данные по автомобилю</h4>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label">Модель и VIN *</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input type="text" name="avto_model" value="" class="form-control input-sm" placeholder="Модель *" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input type="text" name="avto_vin" value="" class="form-control input-sm" placeholder="VIN *" required>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label">Пробег и гос. номер *</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input type="number" name="avto_mileage" value="" class="form-control input-sm" placeholder="Пробег автомобиля *" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input type="text" name="avto_regnumber" value="" class="form-control input-sm" placeholder="Государственный номер *" required>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="header">
                            <h4>Желаемая дата и время сервисного обслуживания</h4>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="recording">
                    <label class="col-sm-3 control-label">Дата и время *</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input type="date" name="service_date" value="" class="form-control input-sm" placeholder="Укажите дату *" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <select name="service_time" class="form-control input-sm" required>
							            <option value="">Укажите время</option>
							            <option value="9:00" >9:00</option>
                                        <option value="10:00" >10:00</option>
                                        <option value="11:00" >11:00</option>
                                        <option value="12:00" >12:00</option>
                                        <option value="13:00" >13:00</option>
                                        <option value="14:00" >14:00</option>
                                        <option value="15:00" >15:00</option>
                                        <option value="16:00" >16:00</option>
                                        <option value="17:00" >17:00</option>
                                        <option value="18:00" >18:00</option>
                                        <option value="19:00" >19:00</option>
                                        <option value="20:00" >20:00</option>
                                        <option value="21:00" >21:00</option>						
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Комментарий</label>
                    <div class="col-sm-9">
                        <textarea name="message" class="form-control input-sm" placeholder="Комментарий" rows="5"></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="header">
                            <h4>Информация о защите персональных данных</h4>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        Следующие сведения о целях предоставления и условиях обработки Ваших персональных данных: <a href="/contacts/rights/" TARGET="_blank">Правовое уведомление</a>
                    </div>
                </div>
                <div class="visible-xs">
                    <br>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Отметка о согласии *</label>
                    <div class="col-sm-9 checkbox">
                        <label>
					            <input name="confidential" type="checkbox" value="ДА" required> Я внимательно ознакомился и соглашаюсь с условиями обработки моих персональных данных, а также я подтверждаю наличие согласия субъектов иных указанных мной персональных данных с условиями их обработки.
				            </label>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="btn btn-success btn-lg">Отправить запрос</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</main>

<?php include(ROOT.'/views/layouts/footer.php'); ?>
