<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

include "functions.php"; ?>

<main id="c-forms-container" class="cognito c-firefox c-med">
<noindex>

    <form id="c-forms" action="/form/" method="post" enctype="multipart/form-data">
        <div class="c-forms-form" tabindex="0">
            <div class="c-editor" style="display:none;"><input type="text" class="c-forms-form-style"></div>
            <div class="c-forms-form-body toggle-on" sys:attach="toggle"
                 toggle:on="{ binding displayConfirmation, source = {{ Cognito.Forms.model }} }" toggle:action="hide">
                <div class="c-forms-heading">
                    <div class="c-forms-logo" style="display:none;"></div>
                    <div class="c-forms-form-title"><h2>Untitled</h2></div>
                </div>
                <div class="c-forms-template" sys:attach="dataview"
                     dataview:data="{binding entry, source={{ Cognito.Forms.model }} }">
                    <div class="c-forms-form-main c-span-24 c-sml-span-12">
                        <div class="c-name c-field  c-col-1 c-sml-col-1 c-span-8 c-sml-span-12">
                            <div class="c-label  "><label id="c-0-6-label" for="c-0-6">Name <span
                                    class="c-offscreen c-required-screenreaders">required</span> <span
                                    class="c-offscreen c-validation-screenreaders">, <span></span></span></label></div>
                            <div class="c-editor"><input type="text" id="c-0-6" placeholder="" name="name"></div>
                            <div class="c-validation" aria-hidden="true"></div>
                        </div>
                        <div class="c-phone c-phone-international c-field  c-col-9 c-sml-col-1 c-span-8 c-sml-span-12  c-required">
                            <div class="c-label  "><label id="c-1-5-label" for="c-1-5">Phone <span
                                    class="c-offscreen c-required-screenreaders">required</span> <span
                                    class="c-offscreen c-validation-screenreaders">, <span>Phone is required.</span></span></label>
                            </div>
                            <div class="c-editor c-editor-phone"><input type="text" name="phone" id="c-1-5" placeholder="+7"
                                                                        autocomplete="tel" novalidate=""></div>
                            <div class="c-validation" aria-hidden="true">Phone is required.</div>
                        </div>
                        <div class="c-text-email c-field  c-col-17 c-sml-col-1 c-span-8 c-sml-span-12">
                            <div class="c-label  "><label id="c-2-4-label" for="c-2-4">E-mail <span
                                    class="c-offscreen c-required-screenreaders">required</span> <span
                                    class="c-offscreen c-validation-screenreaders">, <span></span></span></label></div>
                            <div class="c-editor"><input type="text" id="c-2-4" placeholder="" name="email"></div>
                            <div class="c-validation" aria-hidden="true"></div>
                        </div>
                        <div class="c-choice-dropdown c-color c-field  c-col-1 c-sml-col-1 c-span-8 c-sml-span-12">
                            <div class="c-label  "><label id="c-3-3-label" for="c-3-3">����� ����� <span
                                    class="c-offscreen c-required-screenreaders">required</span> <span
                                    class="c-offscreen c-validation-screenreaders">, <span></span></span></label></div>
                            <div class="c-editor">
                                <div class="c-dropdown"><select id="c-3-3" type="dropitem">
                                    <option></option>
                                    <option selected="selected" value="red">������</option>
                                    <option value="green">�������</option>
                                    <option value="blue">�����</option>
                                </select></div>
                            </div>
                            <div class="c-validation" aria-hidden="true"></div>
                        </div>
                        <div class="c-text-message c-field  c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                            <div class="c-label  "><label id="c-4-2-label" for="c-4-2">�������� ��������� <span
                                    class="c-offscreen c-required-screenreaders">required</span> <span
                                    class="c-offscreen c-validation-screenreaders">, <span></span></span></label></div>
                            <div class="c-editor"><textarea id="c-4-2" placeholder="" name="texmessage"></textarea></div>
                            <div class="c-validation" aria-hidden="true"></div>
                        </div>
                    </div>
                </div>
                <div id="c-recaptcha-div"></div>
                <div class="left top text" id="n2_57" style="padding-top: 39px;">*</div>
                <div class="left top text" id="n2_58" style="padding-top: 39px;padding-bottom: 40px;">� ����,
                    ������������ ��� ����������
                </div>

                <div id="c-agree" style=""><input type="checkbox" required="" name="agree">� ��� �������� �� ��������� ������������
                    ������
                </div>
                <div class="c-forms-error">
                    <div aria-hidden="true" class="c-validation"></div>
                </div>
                <div class="c-button-section">
                    <div class="c-action">
                        <button type="submit" class="c-button" id="c-submit-button">Submit</button>
                    </div>
                </div>
            </div>
            <div class="c-forms-confirmation toggle-off" sys:attach="toggle"
                 toggle:on="{binding displayConfirmation, source={{ Cognito.Forms.model }} }" toggle:action="render"
                 style="display: none;"></div>
        </div>
        <input type="hidden" name="NoBots" id="c-nobots"
               value="Qhh72Y66TXMq1cGOffFZYzIr+/kx7wxxt16SUxuYcaWqqC0biQ3jBIA8vGcsNwDot4J+zNZs/PrrJJivWPTE2A==|7a3a9032d5f00e31e40063cba08cc4a3"><input
            type="hidden" name="NoBots" id="c-nobots"
            value="zqEfLOZNpCwAgY1jimOEe067ghRvgTS/pkU82X2PSQyinKQ2YcAsNzknfcQMFQlIiobVvWTDMjRrHgLbP484WQ==|dde397f6c055cf07a01921600199a5d0">
    </form>
</noindex>
</main>