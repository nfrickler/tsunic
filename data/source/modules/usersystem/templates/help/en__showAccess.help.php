<!-- | HELP show access -->
<h2>Access</h2>
<p>
    This page shows a list of all your access settings.
    All access settings are sorted by the modules they belong to.
</p>
<p>
    If you have the right to see the access of all users,
    you will also see a field to choose a user or an accessgroup,
    of whom you want to see the access settings.
<p>
    For every access setting, the following things are shown.
</p>
<dl>
    <dt>Name</dt>
    <dd>The name of the access settings</dd>
    <dt>Access?</dt>
    <dd>Do you have this access?</dd>
    <dt>Default by groups</dt>
    <dd>
	Every user is member of at least one accessgroup.
	These groups have their own accessrights and if not
	defined different, the user will have the same rights
	as his groups.<br/>
	If at least one group has one certain right, the user
	will have it as well unless denied explicitly.
    </dd>
    <dt>Description</dt>
    <dd>A short description of this right</dd>
</dl>
<h2>The access system</h2>
<p>
    At TSunic certain actions need certain rights. Users not having
    the required right, will not be able to do the action.<br/>
    The rights will be set by the administrator or by a user, the
    administrator has given the right to change these access settings.
    Rights can be given to certain users or to complete groups of
    users (see accessgroups).
</p>
<h3>The user "root"</h3>
<p>
    The user "root" has a special function at TSunic. As on UNIX
    operating systems, the root user has all rights and nothing
    can be denied.<br/>
    Moreover, the root user can't be deleted. At installtion you will
    have to set a password for this user before other users will be
    able to register.
</p>
<h3>The user "guest"</h3>
<p>
    The user named "guest" stands for all users, not being logged
    in.
</p>
<h3>Accessgroups</h3>
<p>
    Since it would be hard to define rights for each single user,
    TSunic offers accessgroups. Users can be members of accessgroups
    and will get the rights of these accessgroups. If at least one
    group, the user is member of, have a certain right, the user will
    have it as well (unless denied explicitly).<br/>
    Every user is at least member of the accessgroup "all", the
    administrator can put every user in other groups additionally.
</p>
<p>
    Accessgroups are ordered hierarchically, i.e. child groups will
    inherit all rights from their parents unless the right is given
    or denied for this group explicitly.<br/>
</p>
<h4>Accessgroup "all"</h4>
<p>
    The accessgroup "all" is a special one. Every user of the system
    is member of this group.<br/>
    If you want to set a default value for one access setting, just
    define it for this "all" group.
</p>
