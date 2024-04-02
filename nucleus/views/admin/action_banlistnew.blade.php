<h2>{{ _BAN_ADD_TITLE }}</h2>


<form method="post" action="index.php">

    <h3>{{ _BAN_IPRANGE }}</h3>

    <p>{{ _BAN_IPRANGE_TEXT }}</p>

    <div class="note">
        <strong>{{ _BAN_EXAMPLE_TITLE }}</strong>
        {{ _BAN_EXAMPLE_TEXT }}
    </div>

    <div>
        @if ($ip)
            <input name="iprange" type="radio" value="{{ $ip }}" checked="checked" id="ip_fixed" />
            <label for="ip_fixed">{{ $ip }}</label>
            <br />
            <input name="iprange" type="radio" value="custom" id="ip_custom" />
            <label for="ip_custom">{{ _BAN_IP_CUSTOM }}</label>
            <input name='customiprange' value='{{ $ip }}' maxlength='15' size='15' />
        } @else {
            echo "<input name='iprange' value='custom' type='hidden' />";
            echo "<input name='customiprange' value='' maxlength='15' size='15' />";
        }
        @endif
    </div>

    <h3>{{ _BAN_BLOGS }}</h3>

    <p>{{ _BAN_BLOGS_TEXT }}</p>

    <div>
        <input type="hidden" name="blogid" value="{{ $blogid }}" />
        <input name="allblogs" type="radio" value="0" id="allblogs_one" /><label for="allblogs_one">'{{ $blog->getName() }}'</label>
        <br />
        <input name="allblogs" type="radio" value="1" checked="checked" id="allblogs_all" /><label for="allblogs_all">{{ _BAN_ALLBLOGS }}</label>
    </div>

    <h3>{{ _BAN_REASON_TITLE }}</h3>

    <p>{{ _BAN_REASON_TEXT }}</p>

    <div><textarea name="reason" cols="40" rows="5"></textarea></div>

    <h3>{{ _BAN_ADD_TITLE }}</h3>

    <div>
        <input name="action" type="hidden" value="banlistadd" />
        <?php $manager->addTicketHidden() ?>
        <input type="submit" value="{{ _BAN_ADD_BTN }}" />
    </div>

</form>