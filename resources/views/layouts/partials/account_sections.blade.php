<div class="account-settings">
    <p class="account-title">Settings</p>
    <ul class="settings-list">
        <li><a href="{{ route('account.index') }}" class="settings-item
                {{ is_current_route('account.index') ? 'settings-active' : '' }}">Account information</a></li>
        <li><a href="{{ route('account.password.change') }}" class="settings-item
                {{ is_current_route('account.password.change') ? 'settings-active' : '' }}">Change password</a></li>
        <li><a href="{{ route('account.mail.change') }}" class="settings-item
                {{ is_current_route('account.mail.change') ? 'settings-active' : '' }}">Change email</a></li>
    </ul>
</div>
