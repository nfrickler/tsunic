<!-- | LANGUAGE english -->
<?php
$lang = array(
    'NAME' => 'IssueTracking module',

    // class
    'CLASS__QUEUE__NAMEALL' => 'All queues',

    // types
    'TYPE__ISSUE' => 'Issue',
    'TYPE__QUEUE' => 'Queue',

    // access
    'ACCESS__ADMINQUEUES' => 'Administrate queues',
    'ACCESS__ADMINQUEUES_DESCRIPTION' => 'Allows to administrate the issuetracker queues.',
    'ACCESS__HANDLEISSUES' => 'Handle issues',
    'ACCESS__HANDLEISSUES_DESCRIPTION' => 'Is user allowed to handle issues?',
    'ACCESS__OPENISSUES' => 'Open new issues',
    'ACCESS__OPENISSUES_DESCRIPTION' => 'Allows to open new issues',
    'ACCESS__REMOVEISSUES' => 'Remove issues',
    'ACCESS__REMOVEISSUES_DESCRIPTION' => 'Remove existing issues',

    // tags
    'TAG__ISSUE__NAME' => 'Name',
    'TAG__ISSUE__AUTHOR' => 'Author',
    'TAG__ISSUE__MAINTAINER' => 'Maintainer',
    'TAG__ISSUE__DESCRIPTION' => 'Description',
    'TAG__ISSUE__QUEUE' => 'Queue',
    'TAG__ISSUE__STATUS' => 'Status',
    'TAG__QUEUE__NAME' => 'Name',
    'TAG__QUEUE__DESCRIPTION' => 'Description',

    // selections
    'SELECTIONS__ISSUE__STATUS_NEW' => 'New',
    'SELECTIONS__ISSUE__STATUS_INPROGRESS' => 'In progress',
    'SELECTIONS__ISSUE__STATUS_DONE' => 'Done',
    'SELECTIONS__ISSUE__STATUS_CLOSED' => 'Closed',
    'SELECTIONS__ISSUE__STATUS_REJECTED' => 'Rejected',

    /* issues */

    // showIndex
    'SHOWINDEX__TITLE' => 'Your issues',
    'SHOWINDEX__H1' => 'Your issues',
    'SHOWINDEX__INFOTEXT' => 'This is a summary of all your issues.',
    'SHOWINDEX__TOCREATEISSUE' => 'Create new issue',
    'SHOWINDEX__SUBMIT' => 'Show issues',
    'SHOWINDEX__H1__ISSUESOFQUEUE' => 'Issues in queue "#name#"',

    // showListIssues
    'SHOWLISTISSUES__NOISSUES' => 'No issues found.',

    // showIssue
    'SHOWISSUE__TITLE' => 'Show issue',
    'SHOWISSUE__H1' => 'Issue',
    'SHOWISSUE__TOEDITISSUE' => 'Edit issue',
    'SHOWISSUE__TODELETEISSUE' => 'Delete issue',

    // showCreateIssue
    'SHOWCREATEISSUE__TITLE' => 'Create new issue',
    'SHOWCREATEISSUE__H1' => 'Create new issue',
    'SHOWCREATEISSUE__INFOTEXT' => 'Here you can create a new issue.',
    'SHOWCREATEISSUE__SUBMIT' => 'Create issue',
    'SHOWCREATEISSUE__CANCEL' => 'Cancel',

    // showEditIssue
    'SHOWEDITISSUE__TITLE' => 'Edit issue',
    'SHOWEDITISSUE__H1' => 'Edit issue',
    'SHOWEDITISSUE__INFOTEXT' => 'Here you can edit the issue.',
    'SHOWEDITISSUE__TOSHOWISSUE' => 'Show issue',
    'SHOWEDITISSUE__TOADDTAG' => 'Add tag',
    'SHOWEDITISSUE__SUBMIT' => 'Save changes',
    'SHOWEDITISSUE__CANCEL' => 'Cancel',

    // formIssue
    'FORMISSUE__LEGEND_ID' => 'Issue',

    // createIssue
    'CREATEISSUE__SUCCESS' => 'New issue has been created.',
    'CREATEISSUE__ERROR' => 'An error occurred!',
    'CREATEISSUE__INVALIDVALUE' => 'Invalid input!',

    // editIssue
    'EDITISSUE__SUCCESS' => 'Changes saved.',
    'EDITISSUE__ERROR' => 'An error occurred!',
    'EDITISSUE__INVALIDVALUE' => 'Invalid input (tag: "#field#", value: "#value#")!',

    // showDeleteIssue
    'SHOWDELETEISSUE__TITLE' => 'Delete issue?',
    'SHOWDELETEISSUE__POPUP_DELETE_HEADER' => 'Delete issue?',
    'SHOWDELETEISSUE__POPUP_DELETE_CONTENT' => 'Do you really want to delete this issue?',
    'SHOWDELETEISSUE__POPUP_DELETE_YES' => 'Yes, delete issue',
    'SHOWDELETEISSUE__POPUP_DELETE_NO' => 'No, abbort',

    // deleteIssue
    'DELETEISSUE__SUCCESS' => 'Issue deleted.',
    'DELETEISSUE__ERROR' => 'Issue could not be deleted!',

    /* queues */

    // showIndex
    'SHOWQUEUES__TITLE' => 'Queues',
    'SHOWQUEUES__H1' => 'Queues',
    'SHOWQUEUES__INFOTEXT' => 'This is a summary of all queues.',
    'SHOWQUEUES__NOQUEUE' => 'No queues in queue.',
    'SHOWQUEUES__TOCREATEQUEUE' => 'Create new queue',

    // showQueue
    'SHOWQUEUE__TITLE' => 'Show queue',
    'SHOWQUEUE__H1' => 'Queue',
    'SHOWQUEUE__TOEDITQUEUE' => 'Edit queue',
    'SHOWQUEUE__TODELETEQUEUE' => 'Delete queue',

    // showCreateQueue
    'SHOWCREATEQUEUE__TITLE' => 'Create new queue',
    'SHOWCREATEQUEUE__H1' => 'Create new queue',
    'SHOWCREATEQUEUE__INFOTEXT' => 'Here you can create a new queue.',
    'SHOWCREATEQUEUE__SUBMIT' => 'Create queue',
    'SHOWCREATEQUEUE__CANCEL' => 'Cancel',

    // showEditQueue
    'SHOWEDITQUEUE__TITLE' => 'Edit queue',
    'SHOWEDITQUEUE__H1' => 'Edit queue',
    'SHOWEDITQUEUE__INFOTEXT' => 'Here you can edit the queue.',
    'SHOWEDITQUEUE__TOSHOWQUEUE' => 'Show queue',
    'SHOWEDITQUEUE__TOADDTAG' => 'Add tag',
    'SHOWEDITQUEUE__SUBMIT' => 'Save changes',
    'SHOWEDITQUEUE__CANCEL' => 'Cancel',

    // formQueue
    'FORMQUEUE__LEGEND_ID' => 'Queue',

    // createQueue
    'CREATEQUEUE__SUCCESS' => 'New queue has been created.',
    'CREATEQUEUE__ERROR' => 'An error occurred!',
    'CREATEQUEUE__INVALIDVALUE' => 'Invalid input!',

    // editQueue
    'EDITQUEUE__SUCCESS' => 'Changes saved.',
    'EDITQUEUE__ERROR' => 'An error occurred!',
    'EDITQUEUE__INVALIDVALUE' => 'Invalid input (tag: "#field#", value: "#value#")!',

    // showDeleteQueue
    'SHOWDELETEQUEUE__TITLE' => 'Delete queue?',
    'SHOWDELETEQUEUE__POPUP_DELETE_HEADER' => 'Delete queue?',
    'SHOWDELETEQUEUE__POPUP_DELETE_CONTENT' => 'Do you really want to delete this queue?',
    'SHOWDELETEQUEUE__POPUP_DELETE_YES' => 'Yes, delete queue',
    'SHOWDELETEQUEUE__POPUP_DELETE_NO' => 'No, abbort',

    // deleteQueue
    'DELETEQUEUE__SUCCESS' => 'Queue deleted.',
    'DELETEQUEUE__ERROR' => 'Queue could not be deleted!',

    /* ***************** navigation ******************** */

    '_SYSTEM_NAVIGATION__TOSHOWINDEX' => 'Show summary',
    '_SYSTEM_NAVIGATION__TOSHOWCREATEISSUE' => 'New issue',
    '_SYSTEM_NAVIGATION__TOSHOWQUEUES' => 'Show queues',
    '_HEADER_NAVIGATION__TOINDEX' => 'IssueTracker'
);
?>
