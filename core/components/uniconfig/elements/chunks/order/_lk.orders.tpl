<tr class="ajax-item" onclick="location.href='{$_modx->makeUrl(13)}/{$id}'" onMouseOver="this.style.cursor='pointer';">
    <th scope="row">{$id}</th>
    <td style="padding: 10px 0;" nowrap>{$date | date_format : '%d.%m.%Y'}</td>
    <td style="padding: 10px 0;" nowrap>{$specialization_name}</td>
    <td style="padding: 10px 0;" nowrap>{$status_name}</td>
    <!--<td>
    <a href="{*/$_modx->makeUrl(14)/*}?order={*/$id/*}" class="btn btn-sm btn-default" role="button" title="Открыть"><i class="fa fa-eye"></i></a>
    </td>-->
</tr>