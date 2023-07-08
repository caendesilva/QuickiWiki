{{ Session::has('toast') ? Session::pull('toast')->toHtml() : null }}
