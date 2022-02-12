import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-react";
import {
  Button,
  Card,
  Col,
  Input,
  Modal,
  Popover,
  Row,
  Space,
  Table,
} from "antd";
import { Delete, EditSquare, InfoCircle } from "react-iconly";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import { withTable } from "@/Pages/withTable";

const TankCategory = ({
  loading,
  dataSource,
  pagination,
  handleSearch,
  handleChangeTable,
  getData,
}) => {
  const columns = [
    {
      title: "Nama Kategori",
      dataIndex: "name",
      key: "name",
      sorter: true,
    },
    {
      title: "Ukuran Tabung",
      dataIndex: "size",
      key: "size",
      sorter: true,
    },
    {
      title: "Informasi Tambahan",
      dataIndex: "note",
      key: "note",
      sorter: true,
    },
    {
      title: "Aksi",
      key: "actions",
      render: (text, record) => (
        <Space size="middle">
          <Popover content="Edit">
            <Link href={route(routes.TANK_CATEGORIES_EDIT, record.id)}>
              <Button
                type="default"
                icon={
                  <EditSquare
                    size="medium"
                    set="curved"
                    className="remix-icon"
                  />
                }
              />
            </Link>
          </Popover>
          <Popover content="Delete">
            <Button
              type="primary"
              ghost
              danger
              icon={
                <Delete size="medium" set="curved" className="remix-icon" />
              }
              onClick={handleClickDelete(record.id)}
            />
          </Popover>
        </Space>
      ),
    },
  ];

  const handleClickDelete = (id) => () => {
    const data = dataSource.find((data) => data.id === id);

    Modal.confirm({
      title: 'Hapus kategori tabung "' + data.name + '"?',
      icon: <InfoCircle className="remix-icon" />,
      content: "Data kategori tabung ini akan dihapus secara permanen.",
      onOk: () =>
        Inertia.delete(route(routes.TANK_CATEGORIES_DESTROY, id), {
          onSuccess: () => {
            getData();
          },
        }),
    });
  };

  return (
    <React.Fragment>
      <Row gutter={[0, 32]}>
        <Breadcrumbs breadcrumbs={[{ name: "Kategori Tabung" }]} />
        <Col span={24}>
          <Card className="da-border-color-black-40">
            <Row gutter={[0, 32]}>
              <Col span={24}>
                <h4>Kategori Tabung</h4>
                {/* <p className="da-p1-body">Master Data</p> */}
              </Col>

              <Row justify="space-between" className="da-w-100">
                <Col>
                  <Input placeholder="Search ..." onChange={handleSearch} />
                </Col>
                <Col>
                  <Button type="primary">
                    <Link href={route(routes.TANK_CATEGORIES_CREATE)}>
                      Create
                    </Link>
                  </Button>
                </Col>
              </Row>

              <Col span={24}>
                <Table
                  rowKey="id"
                  columns={columns}
                  dataSource={dataSource}
                  pagination={pagination}
                  loading={loading}
                  onChange={handleChangeTable}
                />
              </Col>
            </Row>
          </Card>
        </Col>
      </Row>
    </React.Fragment>
  );
};

export default withTable(TankCategory, {
  routeAjaxIndex: routes.TANK_CATEGORIES_AJAX_INDEX,
});
