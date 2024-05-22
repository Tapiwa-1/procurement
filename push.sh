
git add .


if [ -z "$1" ]; then
    echo "Please provide a commit message."
    exit 1
fi

git commit -m "$1"


git push