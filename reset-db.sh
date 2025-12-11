#!/bin/bash

echo "🔧 Starting full database reset..."

# Stop containers
echo "🛑 Stopping containers..."
docker compose down

# Remove volume
echo "🗑️  Removing database volume..."
docker volume rm sjp_db_data 2>/dev/null || echo "Volume already removed"

# Start containers
echo "🚀 Starting containers..."
docker compose up -d

# Wait for MySQL
echo "⏳ Waiting for MySQL to be ready..."
sleep 10
until docker compose exec db mysqladmin ping -h localhost -uroot -proot --silent 2>/dev/null; do
    echo "   Still waiting..."
    sleep 3
done
echo "✅ MySQL is ready!"

# Import SQL
if [ -f "sjp (2).sql" ]; then
    echo "📥 Importing sjp (2).sql..."
    docker compose exec -T db mysql -uroot -proot ci3_database < "sjp (2).sql"
    
    if [ $? -eq 0 ]; then
        echo "✅ Import successful!"
    else
        echo "❌ Import failed!"
        exit 1
    fi
else
    echo "❌ Error: sjp (2).sql not found!"
    exit 1
fi

# Verify
echo "🔍 Verifying import..."
docker compose exec db mysql -uroot -proot ci3_database -e "
SELECT 
    table_name,
    table_rows
FROM information_schema.tables
WHERE table_schema = 'ci3_database'
ORDER BY table_rows DESC
LIMIT 10;
"

echo ""
echo "📊 Sample data from user table:"
docker compose exec db mysql -uroot -proot ci3_database --table -e "SELECT * FROM user LIMIT 3;"

echo ""
echo "🎉 Database reset & import completed!"