import { Navigate, Route, Routes } from 'react-router-dom'
import News from './components/News'
import NewsItem from './components/NewsItem'
import PageNotFound from './components/PageNotFound'

function App() {
    return (
        <Routes>
          <Route index element={<Navigate to="news" replace />}></Route>
          <Route path="news" element={<News />}></Route>
          <Route path="news/{id}/item" element={<NewsItem />}></Route>

        <Route path="*" element={<PageNotFound />}>
          {' '}
        </Route>
      </Routes>
    )
}

export default App
